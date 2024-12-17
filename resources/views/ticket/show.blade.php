@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Ticket Details</h1>

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @if($ticket)
    <div class="card mt-4">
        <div class="card-header">
            <h4>{{ $ticket->title }}</h4>
        </div>
        <div class="card-body">
            <p><strong>Description:</strong> {{ $ticket->description }}</p>
            <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
            <p><strong>Sender:</strong>
                @if($ticket->user)
                    {{ $ticket->user->username }}  <!-- Ensure to use the correct field, e.g., 'username' -->
                @else
                    No Sender
                @endif
            </p>
        </div>
    </div>
@else
    <div class="alert alert-warning mt-4">
        Ticket not found.
    </div>
@endif


    </div>
@endsection
