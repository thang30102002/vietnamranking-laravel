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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->unsignedBigInteger('player_id'); // Cột chứa khóa ngoại (cột tham chiếu)
            $table->foreign('player_id') // Định nghĩa khóa ngoại
                ->references('id') // Tham chiếu đến cột `id`
                ->on('players') // Trong bảng `users`
                ->onDelete('cascade'); // Xóa các bản ghi liên quan khi `user` bị xóa
            $table->string('email');
            $table->string('password');
            $table->string('status');
            $table->dateTime('last_login');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
