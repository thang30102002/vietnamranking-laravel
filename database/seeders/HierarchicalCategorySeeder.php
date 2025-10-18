<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class HierarchicalCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear existing categories (only if no news references them)
        Category::whereDoesntHave('news')->delete();

        // Create root categories
        $sports = Category::create([
            'name' => 'Thể thao',
            'description' => 'Tin tức về các môn thể thao',
            'color' => '#FF6B35',
            'icon' => 'fas fa-trophy',
            'is_active' => true,
            'sort_order' => 1
        ]);

        $players = Category::create([
            'name' => 'Cơ thủ',
            'description' => 'Thông tin về các cơ thủ',
            'color' => '#4ECDC4',
            'icon' => 'fas fa-user',
            'is_active' => true,
            'sort_order' => 2
        ]);

        $techniques = Category::create([
            'name' => 'Kỹ thuật',
            'description' => 'Hướng dẫn kỹ thuật chơi billiard',
            'color' => '#45B7D1',
            'icon' => 'fas fa-cog',
            'is_active' => true,
            'sort_order' => 3
        ]);

        $events = Category::create([
            'name' => 'Sự kiện',
            'description' => 'Các sự kiện và hoạt động',
            'color' => '#96CEB4',
            'icon' => 'fas fa-calendar',
            'is_active' => true,
            'sort_order' => 4
        ]);

        // Create child categories for Sports
        Category::create([
            'name' => 'Giải đấu quốc tế',
            'description' => 'Các giải đấu billiard quốc tế',
            'color' => '#FF6B35',
            'icon' => 'fas fa-globe',
            'is_active' => true,
            'sort_order' => 1,
            'parent_id' => $sports->id
        ]);

        Category::create([
            'name' => 'Giải đấu trong nước',
            'description' => 'Các giải đấu billiard Việt Nam',
            'color' => '#FF6B35',
            'icon' => 'fas fa-flag',
            'is_active' => true,
            'sort_order' => 2,
            'parent_id' => $sports->id
        ]);

        Category::create([
            'name' => 'Giải đấu địa phương',
            'description' => 'Các giải đấu billiard địa phương',
            'color' => '#FF6B35',
            'icon' => 'fas fa-map-marker',
            'is_active' => true,
            'sort_order' => 3,
            'parent_id' => $sports->id
        ]);

        // Create child categories for Players
        Category::create([
            'name' => 'Cơ thủ chuyên nghiệp',
            'description' => 'Các cơ thủ chuyên nghiệp',
            'color' => '#4ECDC4',
            'icon' => 'fas fa-star',
            'is_active' => true,
            'sort_order' => 1,
            'parent_id' => $players->id
        ]);

        Category::create([
            'name' => 'Cơ thủ trẻ',
            'description' => 'Các cơ thủ trẻ tài năng',
            'color' => '#4ECDC4',
            'icon' => 'fas fa-child',
            'is_active' => true,
            'sort_order' => 2,
            'parent_id' => $players->id
        ]);

        Category::create([
            'name' => 'Cơ thủ nghiệp dư',
            'description' => 'Các cơ thủ nghiệp dư',
            'color' => '#4ECDC4',
            'icon' => 'fas fa-user',
            'is_active' => true,
            'sort_order' => 3,
            'parent_id' => $players->id
        ]);

        // Create child categories for Techniques
        Category::create([
            'name' => 'Kỹ thuật cơ bản',
            'description' => 'Các kỹ thuật cơ bản trong billiard',
            'color' => '#45B7D1',
            'icon' => 'fas fa-play',
            'is_active' => true,
            'sort_order' => 1,
            'parent_id' => $techniques->id
        ]);

        Category::create([
            'name' => 'Kỹ thuật nâng cao',
            'description' => 'Các kỹ thuật nâng cao trong billiard',
            'color' => '#45B7D1',
            'icon' => 'fas fa-graduation-cap',
            'is_active' => true,
            'sort_order' => 2,
            'parent_id' => $techniques->id
        ]);

        Category::create([
            'name' => 'Chiến thuật',
            'description' => 'Chiến thuật chơi billiard',
            'color' => '#45B7D1',
            'icon' => 'fas fa-chess',
            'is_active' => true,
            'sort_order' => 3,
            'parent_id' => $techniques->id
        ]);

        // Create child categories for Events
        Category::create([
            'name' => 'Hội thảo',
            'description' => 'Các hội thảo về billiard',
            'color' => '#96CEB4',
            'icon' => 'fas fa-chalkboard-teacher',
            'is_active' => true,
            'sort_order' => 1,
            'parent_id' => $events->id
        ]);

        Category::create([
            'name' => 'Triển lãm',
            'description' => 'Các triển lãm về billiard',
            'color' => '#96CEB4',
            'icon' => 'fas fa-palette',
            'is_active' => true,
            'sort_order' => 2,
            'parent_id' => $events->id
        ]);

        Category::create([
            'name' => 'Hoạt động cộng đồng',
            'description' => 'Các hoạt động cộng đồng billiard',
            'color' => '#96CEB4',
            'icon' => 'fas fa-users',
            'is_active' => true,
            'sort_order' => 3,
            'parent_id' => $events->id
        ]);
    }
}