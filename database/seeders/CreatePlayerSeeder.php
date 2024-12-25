<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class CreatePlayerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //player 1
        DB::table('users')->upsert([
            [
                'id' => '1',
                'email' => 'thang@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '2',
                'email' => 'khien@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '3',
                'email' => 'long@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '4',
                'email' => 'thang4@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '5',
                'email' => 'khien5@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '6',
                'email' => 'long6@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '7',
                'email' => 'thang7@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '8',
                'email' => 'khien8@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '9',
                'email' => 'long9@gmail.com',
                'password' => Hash::make('123123123'),
            ]
        ], ['id'], ['email', 'password']);

        DB::table('user_roles')->upsert([
            [
                'id' => '1',
                'user_id' => '1',
                'role_id' => '3',
            ],
            [
                'id' => '2',
                'user_id' => '2',
                'role_id' => '3',
            ],
            [
                'id' => '3',
                'user_id' => '3',
                'role_id' => '3',
            ],
            [
                'id' => '4',
                'user_id' => '4',
                'role_id' => '3',
            ],
            [
                'id' => '5',
                'user_id' => '5',
                'role_id' => '3',
            ],
            [
                'id' => '6',
                'user_id' => '6',
                'role_id' => '3',
            ],
            [
                'id' => '7',
                'user_id' => '7',
                'role_id' => '3',
            ],
            [
                'id' => '8',
                'user_id' => '8',
                'role_id' => '3',
            ],
            [
                'id' => '9',
                'user_id' => '9',
                'role_id' => '3',
            ]
        ], ['id'], ['user_id', 'role_id']);

        DB::table('players')->upsert([
            [
                'id' => '1',
                'name' => 'Nguyễn Quốc Thắng',
                'phone' => '0385656554',
                'user_id' => '1',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 600,
            ],
            [
                'id' => '2',
                'name' => 'Nguyễn Trung Khiên',
                'phone' => '0385656524',
                'user_id' => '2',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 500,
            ],
            [
                'id' => '3',
                'name' => 'Bùi Văn Long',
                'phone' => '0385656564',
                'user_id' => '3',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 400,
            ],
            [
                'id' => '4',
                'name' => 'Nguyễn Văn Giang',
                'phone' => '0385659857',
                'user_id' => '4',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 600,
            ],
            [
                'id' => '5',
                'name' => 'Bùi Mai Thuý',
                'phone' => '0385624367',
                'user_id' => '5',
                'img' => 'fedor.webp',
                'sex' => 'Nữ',
                'point' => 500,
            ],
            [
                'id' => '6',
                'name' => 'Nguyễn Thị Phương',
                'phone' => '0385987987',
                'user_id' => '6',
                'img' => 'fedor.webp',
                'sex' => 'Nữ',
                'point' => 400,
            ],
            [
                'id' => '7',
                'name' => 'Bùi Văn Tài',
                'phone' => '0385656542',
                'user_id' => '7',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 600,
            ],
            [
                'id' => '8',
                'name' => 'Nguyễn Trung Mạnh',
                'phone' => '0385655344',
                'user_id' => '8',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 500,
            ],
            [
                'id' => '9',
                'name' => 'Bùi Văn Long Anh',
                'phone' => '0385656548',
                'user_id' => '9',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 400,
            ]

        ], ['id'], ['name', 'phone', 'user_id', 'sex']);

        DB::table('player_rankings')->upsert([
            [
                'id' => '1',
                'player_id' => '1',
                'ranking_id' => '8',
            ],
            [
                'id' => '2',
                'player_id' => '2',
                'ranking_id' => '9',
            ],
            [
                'id' => '3',
                'player_id' => '3',
                'ranking_id' => '9',
            ],
            [
                'id' => '4',
                'player_id' => '4',
                'ranking_id' => '8',
            ],
            [
                'id' => '5',
                'player_id' => '5',
                'ranking_id' => '9',
            ],
            [
                'id' => '6',
                'player_id' => '6',
                'ranking_id' => '9',
            ],
            [
                'id' => '7',
                'player_id' => '7',
                'ranking_id' => '8',
            ],
            [
                'id' => '8',
                'player_id' => '8',
                'ranking_id' => '9',
            ],
            [
                'id' => '9',
                'player_id' => '9',
                'ranking_id' => '9',
            ]

        ], ['id'], ['player_id', 'ranking_id']);

        DB::table('player_moneys')->upsert([
            [
                'id' => '1',
                'player_id' => '1',
                'money' => 3000000,
            ],
            [
                'id' => '2',
                'player_id' => '2',
                'money' => 1500000,
            ],
            [
                'id' => '3',
                'player_id' => '3',
                'money' => 500000,
            ],
            [
                'id' => '4',
                'player_id' => '4',
                'money' => 3000000,
            ],
            [
                'id' => '5',
                'player_id' => '5',
                'money' => 500000,
            ],
            [
                'id' => '6',
                'player_id' => '6',
                'money' => 300000,
            ],
            [
                'id' => '7',
                'player_id' => '7',
                'money' => 3000000,
            ],
            [
                'id' => '8',
                'player_id' => '8',
                'money' => 100000,
            ],
            [
                'id' => '9',
                'player_id' => '9',
                'money' => 500000,
            ]

        ], ['id'], ['player_id', 'money']);
        ////////
    }
}
