<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    public function handle(Request $request, Closure $next, $role)
    {
        if ($role == 'admin' && !Auth::check() || Auth::user()->is_admin != true) {
            return redirect('/login'); // Redirect to login if user is not admin
        }

        if ($role == 'user' && !Auth::check() || Auth::user()->is_admin == true) {
            return redirect('/login'); // Redirect to login if user is not a normal user
        }

        return $next($request);
    }
}
