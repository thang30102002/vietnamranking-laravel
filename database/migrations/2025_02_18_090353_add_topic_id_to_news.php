<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('news', function (Blueprint $table) {
            // Kiểm tra nếu cột topic_id chưa tồn tại thì thêm vào trước khi tạo khóa ngoại
            if (!Schema::hasColumn('news', 'topic_id')) {
                $table->unsignedBigInteger('topic_id')->nullable()->after('id'); // Thêm cột topic_id có thể null tạm thời
            }
        });

        // Cập nhật các bản ghi hiện có để đảm bảo rằng tất cả các giá trị topic_id đều hợp lệ
        DB::table('news')->whereNull('topic_id')->update(['topic_id' => 1]);

        Schema::table('news', function (Blueprint $table) {
            // Thêm ràng buộc khóa ngoại
            $table->foreign('topic_id')
                ->references('id')
                ->on('topics')
                ->onDelete('cascade');
        });

        // Đặt lại cột topic_id không thể null
        Schema::table('news', function (Blueprint $table) {
            $table->unsignedBigInteger('topic_id')->default(1)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('news', function (Blueprint $table) {
            $table->dropForeign(['topic_id']); // Chỉ xóa khóa ngoại, không xóa cột
            $table->dropColumn('topic_id'); // Xóa cột topic_id
        });
    }
};
