<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    // Define the fillable fields
    protected $fillable = ['title', 'status', 'description', 'user_id'];

    // Optionally, if you want to define relationships, add them here.
}
