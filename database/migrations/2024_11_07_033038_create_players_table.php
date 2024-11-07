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
        Schema::create('players', function (Blueprint $table) {
            $table->id(); // Khóa chính tự tăng
            $table->string('name'); // Cột tên người dùng
            $table->string('phone'); // Cột tên người dùng
            $table->string('ranking'); // Cột tên người dùng
            $table->string('password'); // Mật khẩu
            $table->string('email')->unique(); // Cột email duy nhất
            $table->timestamp('email_verified_at')->nullable(); // Xác thực email
            $table->rememberToken(); // Token ghi nhớ đăng nhập
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('players');
    }
};
