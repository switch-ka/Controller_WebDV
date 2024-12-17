<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageV2 extends Model
{
    use HasFactory;

    protected $table = 'messages_v2'; // Ensure this is correctly set to match your table name

    protected $fillable = ['ticket_id', 'user_id', 'content'];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Optionally, define a helper to get the username
    public function getUsernameAttribute()
    {
        return $this->user ? $this->user->username : 'Guest';
    }
}
