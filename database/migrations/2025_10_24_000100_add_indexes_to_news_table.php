<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Ensure columns exist (safe-guard)
        Schema::table('news', function (Blueprint $table) {
            if (!Schema::hasColumn('news', 'status')) {
                $table->string('status')->default('published')->after('excerpt');
            }
            if (!Schema::hasColumn('news', 'views')) {
                $table->unsignedBigInteger('views')->default(0)->after('status');
            }
        });

        // Add indexes only if they do not already exist
        if (!$this->indexExists('news', 'news_status_created_at_index')) {
            Schema::table('news', function (Blueprint $table) {
                $table->index(['status', 'created_at'], 'news_status_created_at_index');
            });
        }
        if (!$this->indexExists('news', 'news_category_id_index')) {
            Schema::table('news', function (Blueprint $table) {
                $table->index('category_id', 'news_category_id_index');
            });
        }
    }

    public function down(): void
    {
        // Safe to drop compound index on (status, created_at)
        if ($this->indexExists('news', 'news_status_created_at_index')) {
            Schema::table('news', function (Blueprint $table) {
                $table->dropIndex('news_status_created_at_index');
            });
        }
        // Do NOT drop index on category_id because it may be required by a foreign key
        // Intentionally skipping dropping 'news_category_id_index' to avoid MySQL error 1553
    }

    private function indexExists(string $table, string $indexName): bool
    {
        $result = DB::select('SHOW INDEX FROM `'.$table.'` WHERE `Key_name` = ?', [$indexName]);
        return !empty($result);
    }
};


