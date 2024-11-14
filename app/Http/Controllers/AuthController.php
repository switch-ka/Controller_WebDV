<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Handle User login
    public function loginUser(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'user' && $credentials['password'] === 'userpassword') {
            session(['user_type' => 'user']);
            return redirect()->route('create-ticket');
        }

        return redirect()->back()->with('error', 'Invalid username or password');
    }

    // Handle Admin login
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        if ($credentials['username'] === 'admin' && $credentials['password'] === 'adminpassword') {
            session(['user_type' => 'admin']);
            return redirect()->route('view-ticket');
        }

        return redirect()->back()->with('error', 'Invalid username or password');
    }

    // Handle logout
    public function logout()
    {
        session()->forget('user_type');
        return redirect()->route('login'); // Corrected line
    }

}