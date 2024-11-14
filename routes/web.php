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
Route::post('/view-ticet', [TicketController::class, 'store'])
    ->name('view-ticket')
    ->middleware('role:user');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Separate POST routes for user and admin logins
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.submit');
Route::post('/admin-login', [AuthController::class, 'loginAdmin'])->name('admin.login');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin-specific route to view tickets - restricted to users with 'admin' role
Route::get('/view-ticket', [TicketController::class, 'view'])
    ->name('view-ticket')
    ->middleware('role:admin');

    // Admin-specific route to view tickets - restricted to users with 'admin' role
Route::get('/view-ticket', [TicketController::class, 'view'])
->name('view-ticket')
->middleware('role:user');

    Route::post('/store-ticket', [TicketController::class, 'store'])->name('store-ticket');

