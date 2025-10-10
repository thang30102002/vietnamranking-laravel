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
            ],
            [
                'id' => '10',
                'email' => 'player10@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '11',
                'email' => 'player11@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '12',
                'email' => 'player12@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '13',
                'email' => 'player13@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '14',
                'email' => 'player14@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '15',
                'email' => 'player15@gmail.com',
                'password' => Hash::make('123123123'),
            ],
            [
                'id' => '16',
                'email' => 'player16@gmail.com',
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
            ],
            [
                'id' => '10',
                'user_id' => '10',
                'role_id' => '3',
            ],
            [
                'id' => '11',
                'user_id' => '11',
                'role_id' => '3',
            ],
            [
                'id' => '12',
                'user_id' => '12',
                'role_id' => '3',
            ],
            [
                'id' => '13',
                'user_id' => '13',
                'role_id' => '3',
            ],
            [
                'id' => '14',
                'user_id' => '14',
                'role_id' => '3',
            ],
            [
                'id' => '15',
                'user_id' => '15',
                'role_id' => '3',
            ],
            [
                'id' => '16',
                'user_id' => '16',
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
            ],
            [
                'id' => '10',
                'name' => 'Trần Văn Hoàng',
                'phone' => '0385656510',
                'user_id' => '10',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 550,
            ],
            [
                'id' => '11',
                'name' => 'Lê Thị Hương',
                'phone' => '0385656511',
                'user_id' => '11',
                'img' => 'fedor.webp',
                'sex' => 'Nữ',
                'point' => 480,
            ],
            [
                'id' => '12',
                'name' => 'Phạm Minh Tuấn',
                'phone' => '0385656512',
                'user_id' => '12',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 520,
            ],
            [
                'id' => '13',
                'name' => 'Hoàng Văn Nam',
                'phone' => '0385656513',
                'user_id' => '13',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 450,
            ],
            [
                'id' => '14',
                'name' => 'Đặng Thị Mai',
                'phone' => '0385656514',
                'user_id' => '14',
                'img' => 'fedor.webp',
                'sex' => 'Nữ',
                'point' => 490,
            ],
            [
                'id' => '15',
                'name' => 'Võ Văn Đức',
                'phone' => '0385656515',
                'user_id' => '15',
                'img' => 'fedor.webp',
                'sex' => 'Nam',
                'point' => 580,
            ],
            [
                'id' => '16',
                'name' => 'Ngô Thị Lan',
                'phone' => '0385656516',
                'user_id' => '16',
                'img' => 'fedor.webp',
                'sex' => 'Nữ',
                'point' => 510,
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
            ],
            [
                'id' => '10',
                'player_id' => '10',
                'ranking_id' => '8',
            ],
            [
                'id' => '11',
                'player_id' => '11',
                'ranking_id' => '9',
            ],
            [
                'id' => '12',
                'player_id' => '12',
                'ranking_id' => '8',
            ],
            [
                'id' => '13',
                'player_id' => '13',
                'ranking_id' => '9',
            ],
            [
                'id' => '14',
                'player_id' => '14',
                'ranking_id' => '9',
            ],
            [
                'id' => '15',
                'player_id' => '15',
                'ranking_id' => '8',
            ],
            [
                'id' => '16',
                'player_id' => '16',
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
            ],
            [
                'id' => '10',
                'player_id' => '10',
                'money' => 2000000,
            ],
            [
                'id' => '11',
                'player_id' => '11',
                'money' => 800000,
            ],
            [
                'id' => '12',
                'player_id' => '12',
                'money' => 1200000,
            ],
            [
                'id' => '13',
                'player_id' => '13',
                'money' => 600000,
            ],
            [
                'id' => '14',
                'player_id' => '14',
                'money' => 900000,
            ],
            [
                'id' => '15',
                'player_id' => '15',
                'money' => 2500000,
            ],
            [
                'id' => '16',
                'player_id' => '16',
                'money' => 1100000,
            ]

        ], ['id'], ['player_id', 'money']);
        ////////
    }
}
