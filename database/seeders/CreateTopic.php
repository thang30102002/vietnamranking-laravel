<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateTopic extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('topics')->upsert([
            [
                'id' => '1',
                'name' => 'Thế giới',
                'slug' => 'the-gioi',
                'description' => 'Các tin tức billiard trên thế giới',
                'image' => 'http://'
            ],
            [
                'id' => '2',
                'name' => 'Việt Nam',
                'slug' => 'viet-nam',
                'description' => 'Các tin tức billiard ở Việt Nam',
                'image' => 'http://'
            ],
            [
                'id' => '3',
                'name' => 'Chuyên nghiệp',
                'slug' => 'chuyen-nghiep',
                'description' => 'Các tin tức billiard chuyên nghiệp',
                'image' => 'http://'
            ],
            [
                'id' => '4',
                'name' => 'Nghiệp dư',
                'slug' => 'nghiep-du',
                'description' => 'Các tin tức billiard về giải đấu nghiệp dư',
                'image' => 'http://'
            ],
        ], ['id'], ['name', 'slug', 'description','image']);
    }
}
