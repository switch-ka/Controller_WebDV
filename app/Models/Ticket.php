<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
   // Ticket model (Ticket.php)
   public function user()
   {
       return $this->belongsTo(User::class);
   }
}

