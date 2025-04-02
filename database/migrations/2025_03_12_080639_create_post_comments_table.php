<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('post_comments', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự động tăng
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('post_id')->constrained('posts')->onDelete('cascade');
            $table->text('content'); // Nội dung bình luận
            $table->foreignId('parent_id')->nullable()->constrained('post_comments')->onDelete('cascade'); // Bình luận cha
            $table->timestamps(); // Tạo created_at và updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('post_comments');
    }
};

