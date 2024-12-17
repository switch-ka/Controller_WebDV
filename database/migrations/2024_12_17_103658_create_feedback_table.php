<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id(); // auto-incrementing ID
            $table->text('message'); // feedback message
            $table->unsignedBigInteger('ticket_id'); // foreign key to ticket
            $table->unsignedBigInteger('user_id'); // foreign key to user (optional, if you want to track who submitted the feedback)
            $table->timestamps(); // created_at and updated_at columns

            // Foreign key constraints
            $table->foreign('ticket_id')->references('id')->on('tickets')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('feedback');
    }
}
