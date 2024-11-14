<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    // Show the ticket creation form
    public function create()
    {
        return view('create-ticket'); // Make sure this view exists
    }

    // Store the ticket - restricted to users
    public function store(Request $request)
    {
        // Logic for storing the ticket goes here

        return redirect()->route('view-ticket')->with('success', 'Ticket created successfully!');
    }

    // View tickets - restricted to admins
    public function view()
    {
        // Dummy data to simulate tickets
        $tickets = [
            [
                'id' => 1,
                'title' => 'Sample Ticket 1',
                'status' => 'open',
                'description' => 'Description for sample ticket 1',
            ],
            [
                'id' => 2,
                'title' => 'Sample Ticket 2',
                'status' => 'closed',
                'description' => 'Description for sample ticket 2',
            ],
            [
                'id' => 3,
                'title' => 'Sample Ticket 3',
                'status' => 'in-progress',
                'description' => 'Description for sample ticket 3',
            ],
        ];

        return view('view-ticket', compact('tickets'));
    }
}
