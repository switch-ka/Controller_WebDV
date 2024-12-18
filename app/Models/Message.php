<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;
    protected $table = 'messages_v5';

     protected $fillable = ['ticket_id', 'user_id', 'message'];

    // Define the relationship with the Ticket model
    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    // Define the relationship with the User model
    public function user()
{
    return $this->belongsTo(User::class, 'user_id');
}

}
