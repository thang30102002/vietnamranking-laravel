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
        Schema::create('tournaments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
            $table->integer('number_players');
            $table->dateTime('start_date');
            $table->string('address');
            $table->integer('fees');
            $table->integer('status');
            $table->unsignedBigInteger('admin_tournament_id');

            $table->foreign('admin_tournament_id')->references('id')->on('admin_tournaments')->onDelete('cascade');
        
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournaments');
    }
};
