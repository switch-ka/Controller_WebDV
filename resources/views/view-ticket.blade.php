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

                                <!-- Add a link to the ticket's detail page -->
                                <td>
                                    
                                        {{ $ticket['title'] }}
                                    
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
    </style>

@endsection
