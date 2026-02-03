<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\BrokerVerification;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['nullable', 'string', 'in:user,broker'],
        ]);

        $role = $request->input('role', 'user');

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $role,
        ]);

        event(new Registered($user));

        Auth::login($user);

        if ($user->role === 'broker') {
            $brokerRules = [
                'id_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
                'selfie_image' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:4096'],
            ];
            $request->validate($brokerRules);

            $idPath = $request->file('id_image')->store('broker_verifications', 'public');
            $selfiePath = $request->file('selfie_image')->store('broker_verifications', 'public');

            BrokerVerification::create([
                'user_id' => $user->id,
                'id_image' => $idPath,
                'selfie_image' => $selfiePath,
                'status' => 'pending',
            ]);

            return redirect()->route('home.index')
                ->with('success', __('Your broker verification was submitted. Please wait for approval.'));
        }

        return redirect(RouteServiceProvider::HOME);
    }
}
