<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCacheTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->id(); // Thêm cột id tự động tăng
            $table->string('key')->unique(); // Cột 'key' để lưu trữ khóa cache, và unique để đảm bảo không trùng lặp
            $table->text('value'); // Cột 'value' để lưu trữ giá trị cache
            $table->integer('expiration'); // Cột 'expiration' để lưu trữ thời gian hết hạn của cache (tính theo timestamp)
            $table->timestamps(); // Cột 'created_at' và 'updated_at' tự động tạo
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cache');
    }
}
