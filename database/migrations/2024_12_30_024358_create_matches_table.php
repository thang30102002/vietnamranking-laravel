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
        Schema::create('matches', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('round');
            $table->unsignedBigInteger('tournament_id');
            $table->unsignedBigInteger('player_id_win')->nullable();
            $table->unsignedBigInteger('player_id_1');
            $table->unsignedBigInteger('player_id_2');
            $table->string('location');

            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
            $table->foreign('player_id_win')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('player_id_1')->references('id')->on('players')->onDelete('cascade');
            $table->foreign('player_id_2')->references('id')->on('players')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('matches');
    }
};
