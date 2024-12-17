@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Ticket Details</h1>

        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if($ticket)  <!-- Ensure ticket is passed and available -->
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

                    <!-- Display the messages related to the ticket -->
                    <div class="messages mt-4">
                        <h5>Messages:</h5>
                        @if($ticket->messagesV2->count() > 0)
                        @foreach($ticket->messagesV2 as $message)
    <div class="message mb-3">
        <p><strong>{{ $message->username }}:</strong> {{ $message->content }}</p>
        <p><small>Sent at: {{ $message->created_at->format('Y-m-d H:i:s') }}</small></p>
    </div>
@endforeach


                        @else
                            <p>No messages yet.</p>
                        @endif
                    </div>

                    <!-- Add a form to submit a new message -->
                    <div class="mt-4">
                        <h5>Send a Message</h5>
                        <form method="POST" action="{{ route('ticket.addMessageV2', $ticket->id) }}">
                            @csrf
                            <textarea name="message" placeholder="Enter your message here" required></textarea>
                            <button type="submit">Submit Message</button>
                        </form>
                    </div>
                </div>
            </div>
        @else
            <div class="alert alert-warning mt-4">
                Ticket not found.
            </div>
        @endif
    </div>
@endsection
