@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Ticket #{{ $ticket->id }} - {{ $ticket->subject }}</h1>
        <p>{{ $ticket->description }}</p>

        <h3>Feedback Messages</h3>
        @foreach($feedbacks as $feedback)
            <div class="feedback-message">
                <strong>{{ $feedback->user->name }}</strong> ({{ $feedback->created_at->diffForHumans() }}):
                <p>{{ $feedback->message }}</p>
            </div>
        @endforeach

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Form to submit new feedback -->
        <form action="{{ route('feedback.store', $ticket->id) }}" method="POST">
            @csrf
            <textarea name="message" rows="4" placeholder="Write your feedback..." required></textarea>
            <button type="submit" class="btn btn-primary">Send Feedback</button>
        </form>
    </div>
@endsection
