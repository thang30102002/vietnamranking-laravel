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
        Schema::table('news', function (Blueprint $table) {
            // Add new columns if they don't exist
            if (!Schema::hasColumn('news', 'excerpt')) {
                $table->text('excerpt')->nullable();
            }
            if (!Schema::hasColumn('news', 'status')) {
                $table->enum('status', ['draft', 'published'])->default('draft');
            }
            if (!Schema::hasColumn('news', 'author_id')) {
                $table->unsignedBigInteger('author_id');
                $table->foreign('author_id')->references('id')->on('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('news', 'views')) {
                $table->integer('views')->default(0);
            }
            
            // Add indexes
            $table->index(['status', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropColumn(['excerpt', 'status', 'author_id', 'views']);
            $table->dropIndex(['status', 'created_at']);
        });
    }
};
