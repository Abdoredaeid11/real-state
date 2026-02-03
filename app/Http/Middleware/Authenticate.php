<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        if ($request->expectsJson()) {
            return null;
        }

        $firstSegment = $request->segment(1);  // e.g. 'admin' or 'ar'
        $secondSegment = $request->segment(2); // e.g. 'admin' in 'ar/admin/dashboard'

        if ($firstSegment === 'admin' || $secondSegment === 'admin') {
            return route('admin.login.form');
        }

        return route('login');
    }
}
