<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Allow storing long CDN URLs in image column
        Schema::table('news', function (Blueprint $table) {
            $table->text('image')->nullable()->change();
        });
    }

    public function down(): void
    {
        // Revert back to string(255)
        Schema::table('news', function (Blueprint $table) {
            $table->string('image')->nullable()->change();
        });
    }
};


