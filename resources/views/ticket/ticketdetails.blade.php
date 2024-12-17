@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ticket #{{ $ticket->id }} - {{ $ticket->title }}</h1>
        <p>{{ $ticket->description }}</p>
        <p><strong>Status:</strong> {{ ucfirst($ticket->status) }}</p>

        <h3>Feedback Messages</h3>
        @foreach ($feedbacks as $feedback)
            <div class="feedback-message">
                <strong>{{ $feedback->user->name }}</strong> ({{ $feedback->created_at->diffForHumans() }}):
                <p>{{ $feedback->message }}</p>
            </div>
        @endforeach

        <hr>

        <!-- Feedback form for the user to reply to the ticket -->
        @if (auth()->check())
    <form action="{{ route('feedback.store', $ticket->id) }}" method="POST">
        @csrf
        <textarea name="message" rows="4" placeholder="Add your feedback..." required></textarea>
        <button type="submit" class="btn btn-primary">Send Feedback</button>
    </form>
@else
    <p>You must be logged in to submit feedback.</p>
@endif


    </div>
@endsection
