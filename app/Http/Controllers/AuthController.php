<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('login');
    }

    // Show the registration form
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Handle User login
    public function loginUser(Request $request)
    {
        $validated = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Fetch user from the database
        $user = User::where('username', $validated['username'])->first();

        // Check if the user exists and the password matches
        if (!$user || $user->password !== $validated['password']) {
            return back()->with('error', 'Invalid credentials');
        }
        // Store user information in the session
    session(['user_id' => $user->id, 'user_type' => $user->role, 'username' => $user->username]);

        // Store user ID and role in session
        session(['user_id' => $user->id, 'user_type' => $user->role]);

        // Redirect user based on their role (user/admin)
        return redirect()->route('view-ticket');
    }

    // Handle User registration
    public function register(Request $request)
    {
        // Validate incoming data
        $validated = $request->validate([
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'email' => 'required|email|unique:users,email',
        ]);

        // Create a new user instance
        $user = new User();
        $user->username = $validated['username'];  // Assign username
        $user->password = $validated['password'];  // Use plain text password
        $user->role = 'user';  // Default role as 'user'
        $user->email = $validated['email'];  // Assign email
        $user->save();  // Save to the database

        // Return success message and redirect to login page
        return redirect()->route('login')->with('success', 'User registered successfully!');
    }

    // Handle Admin login
    public function loginAdmin(Request $request)
    {
        $credentials = $request->only('username', 'password');

        // Check admin credentials manually
        if ($credentials['username'] === 'admin' && $credentials['password'] === 'adminpassword') {
            session(['user_type' => 'admin']); // Store admin type in session
            return redirect()->route('view-ticket'); // Redirect to admin view ticket page
        }

        // Return error if credentials are invalid
        return redirect()->back()->with('error', 'Invalid username or password');
    }

    // Handle logout
    public function logout()
    {
        session()->flush(); // Clear session data
        return redirect()->route('login'); // Redirect to login page
    }
}
