<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Route;
use App\Models\Ticket;
use App\Models\MessageV2;
use App\Models\Comment;
use Illuminate\Http\Request;

// Route to view a ticket's details
Route::get('/ticket/{id}', function ($id) {
    $ticket = Ticket::find($id);
    if (!$ticket) {
        return redirect('/tickets')->with('error', 'Ticket not found');
    }
    return view('ticket.view', compact('ticket'));
});

Route::post('/tickets/{id}/add-message', [TicketController::class, 'addMessage'])->name('ticket.add-message');

// Removed the auth middleware here, so this route is now open to everyone
Route::post('/ticket/{ticketId}/message', function (Request $request, $ticketId) {
    $request->validate([
        'message' => 'required|string',
    ]);

    // Check if the user is logged in, if not set user_id to null for guest
    $userId = auth()->check() ? auth()->id() : null;

    // Add message to the ticket using the MessageV2 model
    $ticket = Ticket::findOrFail($ticketId);
    $ticket->messagesV2()->create([  // Ensure this uses the messagesV2() relationship
        'user_id' => $userId,  // Either the authenticated user ID or null for guest
        'content' => $request->message,
    ]);

    return redirect()->route('ticket.show', $ticketId)->with('success', 'Message added successfully!');
})->name('ticket.addMessage');

// Route to store comments for tickets
Route::post('/ticket/{id}/comments', function (Request $request, $id) {
    $request->validate(['content' => 'required']);

    Comment::create([
        'ticket_id' => $id,
        'user_id' => auth()->id(), // Admin/User ID
        'content' => $request->content,
    ]);

    return redirect()->route('ticket.show', $id)->with('success', 'Comment added!');
})->name('comments.store');

// Route for viewing the ticket details
Route::get('/ticket/{id}', function ($id) {
    $ticket = Ticket::with('user')->findOrFail($id);
    $comments = Comment::where('ticket_id', $id)->orderBy('created_at')->get();

    return view('ticket.show', compact('ticket', 'comments'));
})->name('ticket.show');

// Make the login page the landing page
Route::get('/', function () {
    return redirect()->route('login');
});

// New route for sending a message (using the MessageV2 model)
Route::post('/ticket/{ticketId}/message-v2', function (Request $request, $ticketId) {
    $request->validate([
        'message' => 'required|string',
    ]);

    // Get user_id (if authenticated) or set as null for guest
    $userId = auth()->check() ? auth()->id() : null;

    // Add message to the ticket
    $ticket = Ticket::findOrFail($ticketId);
    $ticket->messagesV2()->create([  // Use messagesV2() relationship
        'user_id' => $userId,  // Either the authenticated user ID or null for guest
        'content' => $request->message,
    ]);

    return redirect()->route('ticket.show', $ticketId)->with('success', 'Message added successfully!');
})->name('ticket.addMessageV2');


// Route to store feedback (user submitting a new message)
Route::post('/feedback/{ticket}', [FeedbackController::class, 'store'])->name('feedback.store');

// Route to show the create ticket form - restricted to users with 'user' role
Route::get('/create-ticket', [TicketController::class, 'create'])
    ->name('create-ticket')
    ->middleware('role:user');

// Route to update ticket status - restricted to users with 'admin' role
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
