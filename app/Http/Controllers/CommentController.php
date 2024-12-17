<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'ticket_id' => 'required|exists:tickets,id',
            'content' => 'required|string',
        ]);

        // Create the comment
        Comment::create([
            'ticket_id' => $request->ticket_id,
            'user_id' => auth()->id(),
            'content' => $request->input('content', 'No content provided'),
        ]);

        // Redirect or return a response
        return back()->with('success', 'Comment added successfully!');
    }
}
