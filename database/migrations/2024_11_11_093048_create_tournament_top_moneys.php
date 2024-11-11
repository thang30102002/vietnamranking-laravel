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
        Schema::create('tournament_top_moneys', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tournament_id'); 
            $table->foreign('tournament_id') 
                ->references('id') 
                ->on('tournaments') 
                ->onDelete('cascade'); 
            $table->integer('money');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_top_moneys');
    }
};
