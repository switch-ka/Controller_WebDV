@extends('layouts.app')

@section('content')

    <div class="container">
        <h1 class="text-center mt-4">View Tickets</h1>
        <p class="text-center mb-4">This is the page where you can view all tickets.</p>
        
        <!-- Ticket Table -->
        <table class="table table-bordered table-hover">
            <thead>
                <tr style="background-color: #007bff; color: white;">
                    <th>#</th>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @if(count($tickets) > 0)
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td>{{ $ticket['id'] }}</td>
                            <td>{{ $ticket['title'] }}</td>
                            <td class="status-{{ strtolower(str_replace(' ', '-', $ticket['status'])) }}">
                                {{ ucfirst($ticket['status']) }}
                            </td>
                            <td>{{ $ticket['description'] }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center">No tickets found</td>
                    </tr>
                @endif
            </tbody>
        </table>
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
    </style>

@endsection