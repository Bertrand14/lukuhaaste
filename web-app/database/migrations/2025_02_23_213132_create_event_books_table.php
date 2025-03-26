<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('event_books', function (Blueprint $table) {
            $table->id();
            $table->integer('userID');
            $table->integer('bookID');
            $table->integer('typeID');
            $table->integer('pageNb');
            $table->integer('eventID');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('event_books');
    }
};
