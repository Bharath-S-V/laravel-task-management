<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    public function handle($request, Closure $next)
    {
        // Check if the authenticated user is an admin
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request); // Allow access to the route
        }

        // If not admin, redirect to user dashboard
        return redirect()->route('user.dashboard');
    }
}
