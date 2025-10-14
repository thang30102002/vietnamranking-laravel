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
        Schema::create('tournament_data', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tournament_id');
            $table->json('tournament_data'); // Lưu trữ toàn bộ dữ liệu tournament
            $table->json('players'); // Lưu trữ danh sách players
            $table->string('tournament_type')->default('ranking'); // ranking hoặc free
            $table->string('status')->default('active'); // active, completed, cancelled
            $table->timestamp('last_updated')->nullable();
            $table->timestamps();
            
            $table->foreign('tournament_id')->references('id')->on('tournaments')->onDelete('cascade');
            $table->unique('tournament_id'); // Mỗi tournament chỉ có 1 record
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tournament_data');
    }
};
