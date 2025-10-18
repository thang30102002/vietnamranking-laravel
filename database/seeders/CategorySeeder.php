<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Giải đấu',
                'description' => 'Tin tức về các giải đấu billiard trong nước và quốc tế',
                'color' => '#FF6B35',
                'icon' => 'fas fa-trophy',
                'is_active' => true,
                'sort_order' => 1
            ],
            [
                'name' => 'Cơ thủ',
                'description' => 'Thông tin về các cơ thủ nổi tiếng và tài năng trẻ',
                'color' => '#4ECDC4',
                'icon' => 'fas fa-user',
                'is_active' => true,
                'sort_order' => 2
            ],
            [
                'name' => 'Kỹ thuật',
                'description' => 'Hướng dẫn kỹ thuật chơi billiard và tips cải thiện',
                'color' => '#45B7D1',
                'icon' => 'fas fa-cog',
                'is_active' => true,
                'sort_order' => 3
            ],
            [
                'name' => 'Sự kiện',
                'description' => 'Các sự kiện, hội thảo và hoạt động liên quan đến billiard',
                'color' => '#96CEB4',
                'icon' => 'fas fa-calendar',
                'is_active' => true,
                'sort_order' => 4
            ],
            [
                'name' => 'Tin tức chung',
                'description' => 'Tin tức tổng hợp về thế giới billiard',
                'color' => '#FECA57',
                'icon' => 'fas fa-newspaper',
                'is_active' => true,
                'sort_order' => 5
            ],
            [
                'name' => 'Nổi bật',
                'description' => 'Những tin tức nổi bật và đáng chú ý nhất',
                'color' => '#FF9FF3',
                'icon' => 'fas fa-star',
                'is_active' => true,
                'sort_order' => 6
            ]
        ];

        foreach ($categories as $categoryData) {
            Category::create($categoryData);
        }
    }
}