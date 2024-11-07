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
        Schema::create('ranking_tournaments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('tournament_id'); // Cột chứa khóa ngoại (cột tham chiếu)
            $table->foreign('tournament_id') // Định nghĩa khóa ngoại
                ->references('id') // Tham chiếu đến cột `id`
                ->on('tournaments') // Trong bảng `users`
                ->onDelete('cascade'); // Xóa các bản ghi liên quan khi `user` bị xóa
            $table->string('ranking');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ranking_tournaments');
    }
};
