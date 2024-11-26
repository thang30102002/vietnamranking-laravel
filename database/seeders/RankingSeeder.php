<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RankingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('rankings')->upsert([
            [
                'id' => '1',
                'name' => 'CN',
            ],
            [
                'id' => '2',
                'name' => 'A',
            ],
            [
                'id' => '3',
                'name' => 'B',
            ],
            [
                'id' => '4',
                'name' => 'C',
            ],
            [
                'id' => '5',
                'name' => 'D',
            ],
            [
                'id' => '6',
                'name' => 'E',
            ],
            [
                'id' => '7',
                'name' => 'F',
            ],
            [
                'id' => '8',
                'name' => 'G',
            ],
            [
                'id' => '9',
                'name' => 'H',
            ],


        ], ['id'], ['name']);
    }
}
