<!-- resources/views/create-ticket.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create a New Ticket</h1>
    
    <form action="{{ route('store-ticket') }}" method="POST">
        @csrf
        
        <!-- Ticket Title -->
        <div class="form-group">
            <label for="title">Ticket Title:</label>
            <input type="text" id="title" name="title" class="form-control" placeholder="Enter the ticket title" required>
        </div>
        
        <!-- Ticket Description -->
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="4" placeholder="Describe the issue" required></textarea>
        </div>
        
        <!-- Priority Selection -->
        <div class="form-group">
            <label for="priority">Priority:</label>
            <select id="priority" name="priority" class="form-control">
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>
        </div>
        
        <!-- Category Selection -->
        <div class="form-group">
            <label for="category">Category:</label>
            <select id="category" name="category" class="form-control">
                <option value="technical">Technical</option>
                <option value="billing">Billing</option>
                <option value="account">Account</option>
                <option value="other">Other</option>
            </select>
        </div>
        
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Ticket</button>
    </form>
</div>
@endsection
