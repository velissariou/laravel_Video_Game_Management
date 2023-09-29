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
        Schema::create('video_games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained(table: 'users', column: 'id')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');
    
            $table->string('title');
            $table->text('description');
            $table->date('release_date');
            $table->string('genre');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('video_games');
    }
};
