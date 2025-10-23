<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Make parent_id nullable on comments table.
     */
    public function up(): void
    {
        // Use raw SQL to avoid requiring doctrine/dbal for column change
        DB::statement('ALTER TABLE `comments` MODIFY `parent_id` BIGINT UNSIGNED NULL');
    }

    /**
     * Revert parent_id to NOT NULL.
     */
    public function down(): void
    {
        // This will fail if there are NULL values present
        DB::statement('ALTER TABLE `comments` MODIFY `parent_id` BIGINT UNSIGNED NOT NULL');
    }
};


