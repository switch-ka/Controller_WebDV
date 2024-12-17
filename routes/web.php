<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;

// Make the login page the landing page
Route::get('/', function () {
    return redirect()->route('login');
});

// Route to show individual ticket details
Route::get('/ticket/{ticket}', [TicketController::class, 'show'])->name('ticket.show');

// Route to store feedback (user submitting a new message)
Route::post('/feedback/{ticket}', [FeedbackController::class, 'store'])->name('feedback.store');

// Route to show the create ticket form - restricted to users with 'user' role
Route::get('/create-ticket', [TicketController::class, 'create'])
    ->name('create-ticket')
    ->middleware('role:user');

    Route::put('/ticket/{id}/update-status', [TicketController::class, 'updateStatus'])
    ->name('ticket.update-status')
    ->middleware('role:admin');

// Route to handle form submission (store the ticket) - restricted to users with 'user' role
Route::post('/ticket/store', [TicketController::class, 'store'])->name('store-ticket')
    ->middleware('role:user');

// Route to view all tickets - accessible by both admin and user
Route::get('/view-ticket', [TicketController::class, 'view'])
    ->name('view-ticket')
    ->middleware('role:admin,user');

// Route to search tickets - accessible by both admin and user
Route::get('/search', [TicketController::class, 'search'])->name('search-ticket');

// Registration routes
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Login routes
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'loginUser'])->name('login.submit');

// Admin login route
Route::post('/admin/login', [AuthController::class, 'loginAdmin'])->name('admin.login');

// Logout route
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
