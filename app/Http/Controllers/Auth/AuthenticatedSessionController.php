<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    public function createAdminForm(): View
    {
        return view('admin.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $user = auth()->user();

        if ($user) {
            $user->forceFill(['last_seen_at' => now()])->save();
        }

        if ($user->role === 'admin') {
            $locale = app()->getLocale();
            return redirect()->intended(route('admin.dashboard', $locale));
        }

        if ($user->role === 'broker') {
            $locale = app()->getLocale();
            return redirect()->intended(route('broker.dashboard', $locale));
        }

        // المستخدم العادي
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function storeAdminLogin(LoginRequest $request): RedirectResponse
    {
        $request->merge(['role' => 'admin']);
        $request->authenticate();
        $request->session()->regenerate();

        $user = auth()->user();
        if ($user) {
            $user->forceFill(['last_seen_at' => now()])->save();
        }

        $locale = app()->getLocale();
        return redirect()->intended(route('admin.dashboard', $locale));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::check()) {
            $user = Auth::user();
            $user->forceFill(['last_seen_at' => null])->save();
        }

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
