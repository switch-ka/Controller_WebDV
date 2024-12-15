<?php

namespace App\Http\Controllers;

use App\Models\Ticket;  // Ensure you have this model
use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Other methods...

    // Method for admins to view tickets
    public function create()
    {
        return view('create-ticket'); // Make sure this view exists
    }

    public function view()
    {
        // Check if the logged-in user is an admin
        if (session('user_type') === 'admin') {
            // If admin, show all tickets
            $tickets = Ticket::all();
        } else {
            // If regular user, show only their tickets
            $tickets = Ticket::where('user_id', session('user_id'))->get();
        }

        return view('view-ticket', compact('tickets'));
    }

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

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');

        // Search for tickets by title, description, or other attributes
        $tickets = Ticket::where('title', 'like', "%$searchTerm%")
                         ->orWhere('description', 'like', "%$searchTerm%")
                         ->get();

        return view('view-ticket', ['tickets' => $tickets]);
    }
}
