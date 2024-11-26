<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreatePlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->upsert([
            [
                'id' => '1',
                'email' => 'aaaaaaa@gmail.com',
                'password' => '123123123',
            ]
        ], ['id'], ['email', 'password']);

        DB::table('user_roles')->upsert([
            [
                'id' => '1',
                'user_id' => '1',
                'role_id' => '3',
            ]
        ], ['id'], ['user_id', 'role_id']);

        DB::table('players')->upsert([
            [
                'id' => '1',
                'name' => 'Fedor Gorst',
                'phone' => '0389999999',
                'user_id' => '1',

            ]

        ], ['id'], ['name', 'phone', 'user_id']);

        DB::table('player_rankings')->upsert([
            [
                'id' => '1',
                'player_id' => '1',
                'ranking_id' => '2',
            ]

        ], ['id'], ['player_id', 'ranking_id']);
    }
}
