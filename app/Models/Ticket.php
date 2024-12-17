<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    // Define the relationship with the User model
    public function user()
    {
        return $this->belongsTo(User::class);  // Assuming 'User' is the model name for users
    }

    // Relationship to the comments model
    // app/Models/Ticket.php
public function comments()
{
    return $this->hasMany(Comment::class);
}
public function feedbacks()
{
    return $this->hasMany(Feedback::class);
}


}

