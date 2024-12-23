<?php

namespace App\Http\Controllers;
use App\Models\Message;

use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;  // Add this line to use Log

class TicketController extends Controller
{
    // Method to show the form for creating a new ticket
    public function create()
    {
        return view('create-ticket');
    }

    // Method to view ticket details (without comments)
    public function viewTicketDetails($id)
    {
        $ticket = Ticket::with(['user', 'messages.user'])->findOrFail($id);  // Load messages with user data
    
        return view('tickets.view-ticket-details', compact('ticket'));
    }

    // Method for admins to view all tickets or view user-specific tickets
    public function view()
    {
        // Check if the logged-in user is an admin
        if (session('user_type') === 'admin') {
            // If admin, show all tickets with the associated user data
            $tickets = Ticket::with('user')->get();  // Eager load the user relationship
        } else {
            // If regular user, show only their tickets, eager loading user
            $tickets = Ticket::with('user')
                             ->where('user_id', session('user_id'))
                             ->get();  // Eager load the user relationship
        }

        // Return the view with tickets
        return view('view-ticket', compact('tickets'));
    }

    // Store a new ticket (for users)
    public function store(Request $request)
    {
        // Validation (optional, but recommended)
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        // Create and store the new ticket
        $ticket = new Ticket();
        $ticket->title = $request->title;
        $ticket->status = 'open';  // Default status
        $ticket->description = $request->description;
        $ticket->user_id = session('user_id');  // Associate with logged-in user
        $ticket->save();

        return redirect()->route('view-ticket');
    }

    // Method to search for tickets based on the title or description
    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Search for tickets by title, description, or other attributes, eager loading user
        $tickets = Ticket::with('user')  // Eager load user relationship
                         ->where('title', 'like', "%$searchTerm%")
                         ->orWhere('description', 'like', "%$searchTerm%")
                         ->get();

        return view('view-ticket', ['tickets' => $tickets]);
    }

    // Method to update the status of a ticket (admin only)
    public function updateStatus(Request $request, $id)
    {
        // Validate the incoming request
        $request->validate([
            'status' => 'required|in:open,pending,closed',
        ]);

        // Find the ticket by ID
        $ticket = Ticket::findOrFail($id);

        // Update the status
        $ticket->status = $request->input('status');
        $ticket->save();
        Log::info('Test log entry');

        // Redirect back with a success message
        return back()->with('success', 'Ticket status updated successfully!');
    }
    public function addMessage(Request $request, $ticketId)
{
    $request->validate([
        'message' => 'required|string|max:1000',
    ]);

    // Store the new message
    $message = new Message();
    $message->ticket_id = $ticketId;
    $message->user_id = session('user_id'); // assuming the user ID is in the session
    $message->message = $request->message;
    $message->save();

    return back()->with('success', 'Message sent successfully!');
}

    // Method to show ticket details with related messages
    public function showTicket($ticketId)
    {
        // Eager load messages with the associated user
        $ticket = Ticket::with('messages.user')->find($ticketId);
    
        if (!$ticket) {
            return redirect()->route('tickets.index')->with('error', 'Ticket not found.');
        }
    
        return view('ticket.show', compact('ticket'));
    }
    

    // Method to show a ticket (admin or user) without comments
    public function show($ticketId)
    {
        // Find the ticket by ID
        $ticket = Ticket::findOrFail($ticketId);
        
        // Optionally, load feedbacks or related information
        $feedbacks = $ticket->feedbacks; 

        return view('ticket.details', compact('ticket', 'feedbacks'));
    }
}
