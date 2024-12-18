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

                    <!-- Display Ticket Messages -->
                    <h4>Messages:</h4>
                    <div class="messages">
                        @if($ticket->messages->isEmpty())
                            <p>No messages yet.</p>
                        @else
                            @foreach ($ticket->messages as $message)
                                <div class="message">
                                <p><strong>{{ $message->user->username }}</strong> ({{ $message->created_at->format('Y-m-d H:i') }}):</p>
<p>{{ $message->message }}</p>

                                </div>
                            @endforeach
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
