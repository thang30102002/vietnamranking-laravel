<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('game_types')->upsert([
            [
                'id' => '1',
                'name' => '9 bi đơn',
            ],
            [
                'id' => '2',
                'name' => '9 bi đôi',
            ],
            [
                'id' => '3',
                'name' => '8 bi đơn',
            ],
            [
                'id' => '4',
                'name' => '8 bi đôi',
            ],
            [
                'id' => '5',
                'name' => '10 bi đơn',
            ],
            [
                'id' => '6',
                'name' => '10 bi đôi',
            ]


        ], ['id'], ['name']);
    }
}
