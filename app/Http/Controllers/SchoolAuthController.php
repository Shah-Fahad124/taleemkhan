<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SchoolAuthController extends Controller
{
    /**
     * Show the school login form
     */
    public function showLoginForm()
    {
        return view('auth.school-login');
    }

    /**
     * Handle the login attempt
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'emis_code' => 'required|string',
            'password' => 'required|string',
        ]);

         // 🧩 Auto logout admin if logged in
    if (Auth::guard('admin')->check()) {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
    }


        if (Auth::guard('school')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->route('school.dashboard')->with('success', 'Welcome back!');
        }

        return back()->withErrors([
            'emis_code' => 'Invalid EMIS code or password.',
        ])->onlyInput('emis_code');
    }

    /**
     * Logout school
     */
    public function logout(Request $request)
    {
        Auth::guard('school')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('school.login')->with('success', 'Logged out successfully.');
    }
}
