<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('my-account');
    }

    // Handle login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'nullable|in:user,broker,admin'
        ]);

        $attempt = [
            'email' => $credentials['email'],
            'password' => $credentials['password'],
        ];
        if (!empty($credentials['role'])) {
            $attempt['role'] = $credentials['role'];
        }

        if (Auth::attempt($attempt)) {
            $request->session()->regenerate();
            $user = auth()->user();
            $locale = config('app.locale', 'ar');

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin.dashboard', $locale));
            }

            if ($user->role === 'broker') {
                return redirect()->intended(route('broker.dashboard', $locale));
            }

            return redirect()->intended(route('home.index'));
        }

        return back()->withErrors([
            'email' => 'Invalid credentials'
        ]);
    }

    // Show registration form
    public function showRegistrationForm()
    {
        return view('my-account');
    }

    // Handle registration
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'role' => 'nullable|in:user,broker'
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => $validated['role'] ?? 'user'
        ]);

        Auth::login($user);

        $locale = config('app.locale', 'ar');

        if ($user->role === 'broker') {
            return redirect()->route('broker.dashboard', $locale);
        }

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard', $locale);
        }

        return redirect()->route('home.index');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
