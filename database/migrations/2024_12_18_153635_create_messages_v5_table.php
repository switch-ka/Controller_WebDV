<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesV5Table extends Migration
{
    public function up()
    {
        Schema::create('messages_v5', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained('tickets')->onDelete('cascade');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->text('message');
            $table->timestamps(); // This will automatically add created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages_v5');
    }
}
