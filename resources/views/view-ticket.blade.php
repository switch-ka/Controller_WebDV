@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center mt-4">View Tickets</h1>
        <p class="text-center mb-4">This is the page where you can view all tickets.</p>

        <!-- Display User ID -->
        @if (isset($error))
            <div class="alert alert-danger text-center">
                {{ $error }}
            </div>
        @else
            <!-- Ticket Table -->
            <table class="table table-bordered table-hover">
                <thead>
                    <tr style="background-color: #007bff; color: white;">
                        <th>#</th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Description</th>
                        <th>Status</th> <!-- New column for styled status -->
                    </tr>
                </thead>
                <tbody>
                    @if(count($tickets) > 0)
                        @foreach ($tickets as $ticket)
                            <tr>
                                <td>{{ $ticket['id'] }}</td>

                                <!-- Add a link to open modal -->
                                <td>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#ticketModal{{ $ticket['id'] }}">
                                        {{ $ticket['title'] }}
                                    </a>
                                </td>

                                <td class="status-{{ strtolower(str_replace(' ', '-', $ticket['status'])) }}">
                                    {{ ucfirst($ticket['status']) }}
                                </td>
                                <td>{{ $ticket['description'] }}</td>
                                <td class="status-{{ strtolower(str_replace(' ', '-', $ticket['status'])) }}">
                                    <!-- Display styled status -->
                                    <span class="status-label">{{ ucfirst($ticket['status']) }}</span>
                                </td>
                                @if (session('user_type') === 'admin')
                                    <td>{{ $ticket->user->name }}</td> <!-- Assuming user relationship exists -->
                                @endif
                                <!-- Add a form for Admin to update the status -->
                                @if (session('user_type') === 'admin')
                                    <td>
                                        <form action="{{ route('ticket.update-status', $ticket['id']) }}" method="POST" id="status-form-{{ $ticket['id'] }}">
                                            @csrf
                                            @method('PUT')
                                            <select name="status" onchange="document.getElementById('status-form-{{ $ticket['id'] }}').submit()" required>
                                                <option value="open" {{ $ticket['status'] === 'open' ? 'selected' : '' }}>Open</option>
                                                <option value="pending" {{ $ticket['status'] === 'pending' ? 'selected' : '' }}>Pending</option>
                                                <option value="closed" {{ $ticket['status'] === 'closed' ? 'selected' : '' }}>Closed</option>
                                            </select>
                                        </form>
                                    </td>
                                @endif
                            </tr>

                            <!-- Modal for Ticket Details -->
                            <div class="modal fade" id="ticketModal{{ $ticket['id'] }}" tabindex="-1" aria-labelledby="ticketModalLabel{{ $ticket['id'] }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="ticketModalLabel{{ $ticket['id'] }}">{{ $ticket['title'] }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p><strong>Status:</strong> {{ ucfirst($ticket['status']) }}</p>
                                            <p><strong>Description:</strong> {{ $ticket['description'] }}</p>
                                            @if (session('user_type') === 'admin')
                                                <p><strong>Assigned To:</strong> {{ $ticket->user->name }}</p>
                                            @endif

                                           <!-- Display Ticket Messages -->
                                            <h4>Messages:</h4>
                                            <div class="messages">
                                                @if($ticket->messages->isEmpty())
                                                    <p>No messages yet.</p>
                                                @else
                                                    @foreach ($ticket->messages as $message)
                                                        <div class="message {{ $message->user->role === 'admin' ? 'admin-message' : 'user-message' }}">
                                                            <p><strong>{{ $message->user->username }}</strong> ({{ $message->created_at->format('Y-m-d H:i') }}):</p>
                                                            <p>{{ $message->message }}</p>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <!-- Send New Message Form -->
                                            @if ($ticket->status !== 'closed')
                                                <form action="{{ route('ticket.add-message', $ticket->id) }}" method="POST">
                                                    @csrf
                                                    <div class="form-group">
                                                        <textarea name="message" rows="4" class="form-control" placeholder="Type your message here..." required></textarea>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary mt-2">Send Message</button>
                                                </form>
                                            @else
                                                <p class="text-danger">This ticket is closed. You cannot reply anymore.</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6" class="text-center">No tickets found</td>
                        </tr>
                    @endif
                </tbody>
            </table>

        @endif
    </div>

    <style>
        /* General Body Styling */
        h1 {
            font-size: 2rem;
        }

        /* Table Styling */
        .table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .table th, .table td {
            padding: 15px;
            text-align: left;
            border: 1px solid #ddd;
        }

        .table th {
            text-transform: uppercase;
        }

        .table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .table tr:hover {
            background-color: #f1f1f1;
        }

        /* Status Colors */
        .status-open {
            color: green;
            font-weight: bold;
        }

        .status-closed {
            color: red;
            font-weight: bold;
        }

        .status-in-progress {
            color: orange;
            font-weight: bold;
        }

        /* Status with Design */
        .status-label {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
            color: white;
            font-weight: bold;
        }

        .status-open .status-label {
            background-color: green;
        }

        .status-pending .status-label {
            background-color: orange;
        }

        .status-closed .status-label {
            background-color: red;
        }

        /* Messages Styling */
        .messages {
            margin-top: 15px;
            border-top: 1px solid #ccc;
            padding-top: 15px;
        }

        .message {
            margin-bottom: 10px;
        }

        .message p {
            margin: 0;
        }

        .admin-message {
            background-color: #d1e7dd;
            padding: 10px;
            border-radius: 5px;
        }

        .user-message {
            background-color: #f8d7da;
            padding: 10px;
            border-radius: 5px;
        }

        /* Disable Reply on Closed Ticket */
        .ticket-closed .message-form {
            display: none;
        }
    </style>

@endsection
