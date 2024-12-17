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
   public function messages()
{
    return $this->hasMany(Message::class); // Assuming a ticket can have many messages
}
public function messagesV2()
{
    return $this->hasMany(MessageV2::class);
}

}

