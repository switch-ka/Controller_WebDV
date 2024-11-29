<?php

namespace App\Http\Controllers;

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
            [
                'id' => 4,
                'title' => 'Sample Ticket 3',
                'status' => 'Open',
                'description' => 'Description for sample ticket 4 ',
            ],
            [
                'id' => 5,
                'title' => 'Sample Ticket 3',
                'status' => 'in-progress',
                'description' => 'Description for sample ticket 5',
            ],
            [
                'id' => 6,
                'title' => 'Sample Ticket 3',
                'status' => 'Closed',
                'description' => 'Description for sample ticket 6',
            ],
            [
                'id' => 7,
                'title' => 'Sample Ticket 3',
                'status' => 'Open',
                'description' => 'Description for sample ticket 7',
            ],
            [
                'id' => 8,
                'title' => 'Sample Ticket 3',
                'status' => 'Open',
                'description' => 'Description for sample ticket 8',
            ],
        ];

        return view('view-ticket', compact('tickets'));
    }

    public function search(Request $request)
    {
        $searchTerm = $request->input('search');
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
            [
                'id' => 4,
                'title' => 'Sample Ticket 3',
                'status' => 'Open',
                'description' => 'Description for sample ticket 4 ',
            ],
            [
                'id' => 5,
                'title' => 'Sample Ticket 3',
                'status' => 'in-progress',
                'description' => 'Description for sample ticket 5',
            ],
            [
                'id' => 6,
                'title' => 'Sample Ticket 3',
                'status' => 'Closed',
                'description' => 'Description for sample ticket 6',
            ],
            [
                'id' => 7,
                'title' => 'Sample Ticket 3',
                'status' => 'Open',
                'description' => 'Description for sample ticket 7',
            ],
            [
                'id' => 8,
                'title' => 'Sample Ticket 3',
                'status' => 'Open',
                'description' => 'Description for sample ticket 8',
            ],
        ];
        // Filter tickets based on the search term
    $filteredTickets = array_filter($tickets, function ($ticket) use ($searchTerm) {
        return str_contains((string)$ticket['id'], $searchTerm);
    });

    return view('view-ticket', ['tickets' => $filteredTickets]);
    }
}