<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Make the login page the landing page
Route::get('/', function () {
    return redirect()->route('login');
});

// Route to show the create ticket form - restricted to users with 'user' role
Route::get('/create-ticket', [TicketController::class, 'create'])
    ->name('create-ticket')
    ->middleware('role:user');

// Route to handle form submission (store the ticket) - restricted to users with 'user' role
Route::post('/store-ticket', [TicketController::class, 'store'])
    ->name('store-ticket')
    ->middleware('role:user');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Separate POST routes for user and admin logins
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.submit');
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Route to view all tickets - accessible by both admin and user
Route::get('/view-ticket', [TicketController::class, 'view'])
    ->name('view-ticket')
    ->middleware('role:admin,user');

// Route to search tickets - accessible by both admin and user
Route::get('/search', [TicketController::class, 'search'])->name('search-ticket');

// Route to show the registration form
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');

// Route to handle form submission (register a new user)
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');
