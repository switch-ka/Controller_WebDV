@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="text-center mt-4">Ticket Details</h1>
        <p class="text-center mb-4">Full details for the ticket titled "{{ $ticket->title }}"</p>

        <div class="ticket-details">
            <h3>Title: {{ $ticket->title }}</h3>
            <p class="text-center">User ID: {{ session('user_id') }}</p> <!-- Displaying the logged-in user ID -->
            <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>
            <p><strong>Description:</strong> {{ $ticket->description }}</p>

            @if (session('user_type') === 'admin')
                <p><strong>Sender:</strong> {{ $ticket->user->name }}</p> <!-- Display sender's name -->
            @endif

            <h4>Comments</h4>
            <ul>
                @foreach ($ticket->comments as $comment)
                    <li>
                        <strong>{{ $comment->user->name }}:</strong> {{ $comment->comment }}
                    </li>
                @endforeach
            </ul>

            <!-- Display success or error messages -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            @if (auth()->check()) <!-- Ensure the user is logged in -->
    @if ($ticket->status !== 'closed')
    <form action="{{ route('store-comment', $ticket->id) }}" method="POST">
    @csrf
    <textarea name="comment" required></textarea>
    <button type="submit">Submit Comment</button>
</form>

    @else
        <p>This ticket is closed. You cannot add comments.</p>
    @endif
@else
    <p>You must be logged in to add a comment.</p>
@endif

        </div>
    </div>
@endsection
