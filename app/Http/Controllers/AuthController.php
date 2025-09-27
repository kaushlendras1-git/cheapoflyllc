<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use DB;


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

        $fieldType = filter_var($loginField, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        $credentials = [
            $fieldType => $loginField,
            'password' => $password
        ];

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user && $user->status == 1) {
                $request->session()->regenerate();

                // 👉 Capture client IP
                $loginIp = $request->ip();
                // 👉 Capture server details (Windows example)
                // $output = shell_exec("ipconfig");
                // preg_match('/IPv4 Address.*?: ([\d\.]+)/', $output, $ipv4);
                // preg_match('/Subnet Mask.*?: ([\d\.]+)/', $output, $subnet);
                // preg_match('/Default Gateway.*?: ([\d\.]+)/', $output, $gateway);

                $serverDetails = [
                    // 'ipv4'   => $ipv4[1] ?? null,
                    // 'subnet' => $subnet[1] ?? null,
                    // 'gateway'=> $gateway[1] ?? null,

                    'ipv4'   => null,
                    'subnet' => null,
                    'gateway'=> null,

                    
                ];

                $user = Auth::user();
                $user->last_login_ip = $loginIp;
                $user->server_network = $serverDetails;
                $user->save();
                             
              

                // JSON response for AJAX
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
