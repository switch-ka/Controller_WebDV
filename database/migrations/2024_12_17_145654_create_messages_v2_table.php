<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesV2Table extends Migration
{
    public function up()
    {
        Schema::create('messages_v2', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ticket_id')->constrained()->onDelete('cascade');  // Foreign key to tickets
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('set null');  // Foreign key to users (nullable for guest users)
            $table->text('content');  // Message content
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('messages_v2');
    }
}
