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
                'name' => 'K',
            ],
            [
                'id' => '2',
                'name' => 'K+',
            ],
            [
                'id' => '3',
                'name' => 'I',
            ],
            [
                'id' => '4',
                'name' => 'I+',
            ],
            [
                'id' => '5',
                'name' => 'H',
            ],
            [
                'id' => '6',
                'name' => 'H+',
            ],
            [
                'id' => '7',
                'name' => 'G',
            ],
            [
                'id' => '8',
                'name' => 'G+',
            ],
            [
                'id' => '9',
                'name' => 'F',
            ],
            [
                'id' => '10',
                'name' => 'F+',
            ],
            [
                'id' => '11',
                'name' => 'E',
            ],
            [
                'id' => '12',
                'name' => 'E+',
            ],
            [
                'id' => '13',
                'name' => 'D',
            ],
            [
                'id' => '14',
                'name' => 'D+',
            ],
            [
                'id' => '15',
                'name' => 'C',
            ],
            [
                'id' => '16',
                'name' => 'C+',
            ],
            [
                'id' => '17',
                'name' => 'B',
            ],
            [
                'id' => '18',
                'name' => 'B+',
            ],
            [
                'id' => '19',
                'name' => 'A',
            ],
            [
                'id' => '20',
                'name' => 'A+',
            ],
            [
                'id' => '21',
                'name' => 'CN',
            ]
        ], ['id'], ['name']);
    }
}
