<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            // Redirect admin routes to admin login page
            if ($request->is('admin/*')) {
                return route('admin.login');
            }

            // Redirect normal users to default login
            return route('school.login');
        }

        // For API requests
        return null;
    }
}
