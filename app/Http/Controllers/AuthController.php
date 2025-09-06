<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


class AuthController extends Controller
{
    // Show login form
    public function showLoginForm()
    {
        return view('web.login');
    }


    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        $loginField = $request->input('email');
        $password = $request->input('password');
        
        // Determine if login field is email or username
        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';
        
        $credentials = [
            $fieldType => $loginField,
            'password' => $password
        ];

        if (Auth::attempt($credentials)) {
            if (Auth::user() && Auth::user()->status == 1) {
                $request->session()->regenerate();

                // Return JSON response for AJAX requests
                if ($request->expectsJson()) {
                    return response()->json(['success' => true]);
                }

                return redirect()->intended('dashboard');
            } else {
                Auth::logout();

                if ($request->expectsJson()) {
                    return response()->json(['error' => 'Access denied. Your account is inactive.'], 403);
                }

                return back()->withErrors([
                    'error' => 'Access denied. Your account is inactive.',
                ]);
            }
        }

        if ($request->expectsJson()) {
            return response()->json(['error' => 'The provided credentials do not match our records.'], 401);
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Show registration form
    public function showRegisterForm()
    {
        return view('web.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        return redirect()->route('login');
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
