<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('messages_v2', function (Blueprint $table) {
        $table->string('username')->nullable();  // Add the 'username' column to store the user's name
    });
}

public function down()
{
    Schema::table('messages_v2', function (Blueprint $table) {
        $table->dropColumn('username');  // Remove the 'username' column if needed
    });
}

};
