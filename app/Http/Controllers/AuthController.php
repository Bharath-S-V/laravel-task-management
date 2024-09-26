<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.login'); // Show the login form
    }

    public function userLogin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login for the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => false])) {
            return redirect()->intended(route('user.dashboard')); // Redirect to User dashboard
        }

        // If login failed
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }

    public function adminLogin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login for the admin
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'is_admin' => true])) {
            return redirect()->intended(route('admin.dashboard')); // Redirect to Admin dashboard
        }

        // If login failed
        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ]);
    }


    public function logout(Request $request)
    {
        // Perform logout
        auth()->logout();

        // Invalidate the session
        $request->session()->invalidate();

        // Regenerate CSRF token
        $request->session()->regenerateToken();

        // Redirect to the homepage or desired route after logout
        return redirect()->route('login')->with('status', 'You have been logged out!');
    }
}
