@extends('layouts.app')

@section('content')

    <div class="container">
        <h1>View Tickets</h1>
        <p>This is the page where you can view all tickets.</p>
        <!-- resources/views/view-ticket.blade.php -->

<h1>Admin - View Tickets</h1>

@foreach ($tickets as $ticket)
    <div>
        <h3>Ticket #{{ $ticket['id'] }}: {{ $ticket['title'] }}</h3>
        <p>Status: {{ $ticket['status'] }}</p>
        <p>Description: {{ $ticket['description'] }}</p>
        <hr>
    </div>
@endforeach

    </div>
@endsection
