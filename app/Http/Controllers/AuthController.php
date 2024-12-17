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

    // Handle Admin registration
    public function registerAdmin(Request $request)
{
    dd($request->all());  // This will dump all the submitted form data

    // Validate incoming data for admin registration
    $validated = $request->validate([
        'username' => 'required|unique:users,username',
        'password' => 'required|min:6',
        'email' => 'required|email|unique:users,email',
        'role' => 'required|in:user,admin', // Ensure both user and admin are accepted
        'admin_key' => 'required_if:role,admin', // Admin key required if role is admin
    ]);

    // Check if the role is 'admin' and validate the admin key
    if ($validated['role'] === 'admin' && $validated['admin_key'] !== 'admin_secret_key') {
        return redirect()->back()->with('error', 'Invalid admin key');
    }

    // Continue with user creation...
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
            'role' => 'required|in:user,admin',  // Ensure only user or admin is allowed
            'admin_key' => 'required_if:role,admin|in:admin_secret_key', // Admin key validation only if role is 'admin'
        ]);
    
        // If the role is 'admin' and the admin_key is not correct
        if ($validated['role'] === 'admin' && $validated['admin_key'] !== 'admin_secret_key') {
            return back()->with('error', 'Invalid admin key');
        }
    
        // Create a new user instance
        $user = new User();
        $user->username = $validated['username'];  // Assign username
        $user->password = $validated['password'];  // Use plain text password
        $user->role = $validated['role'];  // Assign role (user or admin)
        $user->email = $validated['email'];  // Assign email
        $user->save();  // Save to the database
    
        // Return success message and redirect to login page
        return redirect()->route('login')->with('success', 'User registered successfully!');
    }
   
    

    // Handle Admin login
    // Handle Admin login
public function loginAdmin(Request $request)
{
    // Validate the incoming request data
    $validated = $request->validate([
        'username' => 'required',
        'password' => 'required',
    ]);

    // Fetch the user from the database
    $user = User::where('username', $validated['username'])->first();

    // Check if the user exists and the role is 'admin'
    if (!$user || $user->role !== 'admin') {
        return redirect()->back()->with('error', 'Unauthorized access. Admins only.');
    }

    // Check if the password matches
    if ($user->password !== $validated['password']) {
        return redirect()->back()->with('error', 'Invalid credentials.');
    }

    // Store user information in the session
    session(['user_id' => $user->id, 'user_type' => $user->role, 'username' => $user->username]);

    // Redirect the admin to the ticketing system
    return redirect()->route('view-ticket')->with('success', 'Welcome, Admin!');
}


    // Handle logout
    public function logout()
    {
        session()->flush(); // Clear session data
        return redirect()->route('login'); // Redirect to login page
    }
}
