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
        // Xóa khóa ngoại topic_id từ bảng news trước
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['topic_id']);
        });
        
        // Xóa cột topic_id từ bảng news
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn('topic_id');
        });
        
        // Xóa bảng topics
        Schema::dropIfExists('topics');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tạo lại bảng topics
        Schema::create('topics', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        
        // Thêm lại cột topic_id vào bảng news
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('topic_id')->nullable()->after('id');
        });
        
        // Thêm lại khóa ngoại
        Schema::table('news', function (Blueprint $table) {
            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
                ->onDelete('cascade');
        });
    }
};
