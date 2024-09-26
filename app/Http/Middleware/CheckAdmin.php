<?php

// app/Http/Middleware/CheckAdmin.php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the authenticated user is an admin
        if (Auth::check() && Auth::user()->is_admin == 1) {
            return $next($request); // Allow access if admin
        }

        // Optionally, you can return a forbidden response or redirect to a different route
        return redirect()->route('user.dashboard')->with('error', 'You do not have admin access.'); // Redirect if not admin
    }
}
