<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Ticket;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    // Display the ticket with feedback messages
    public function show($ticketId)
    {
        $ticket = Ticket::findOrFail($ticketId);
        $feedbacks = Feedback::where('ticket_id', $ticketId)->get();

        return view('ticket.show', compact('ticket', 'feedbacks'));
    }

    // Store new feedback message
    public function store(Request $request, $ticketId)
    {
        // Validate the incoming request
        $request->validate([
            'message' => 'required|string',
        ]);
    
        // Ensure the user is logged in
        if (auth()->check()) {
            // Store feedback
            Feedback::create([
                'message' => $request->message,
                'ticket_id' => $ticketId,
                'user_id' => auth()->id(), // Use the authenticated user's ID
            ]);
    
            // Redirect back to the ticket details page
            return redirect()->route('ticket.show', $ticketId)->with('success', 'Feedback submitted successfully.');
        } else {
            return redirect()->route('login')->with('error', 'You must be logged in to submit feedback.');
        }
    }
    

}
