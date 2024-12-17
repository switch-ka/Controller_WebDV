<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
{
    // Validate the incoming request
    $request->validate([
        'comment' => 'required|string',
        'ticket_id' => 'required|integer',
    ]);

    // Create a new comment instance
    $comment = new Comment();
    
    // Set the user_id to the authenticated user
    $comment->user_id = auth()->id(); // This ensures the comment is linked to the logged-in user
    
    // Set other comment data
    $comment->comment = $request->comment;
    $comment->ticket_id = $request->ticket_id;
    
    // Save the comment
    $comment->save();

    // Redirect back to the ticket details page with a success message
    return redirect()->route('view-ticket-details', ['id' => $request->ticket_id])
                     ->with('success', 'Comment added successfully!');
}

}
