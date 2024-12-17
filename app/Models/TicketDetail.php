<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = 'tickets';  // Specify the correct table name if it's not the default

    // Define the relationship to the User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
