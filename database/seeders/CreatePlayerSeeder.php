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
                'img' => 'fedor.webp',
                'sex' => 'Nam',

            ]

        ], ['id'], ['name', 'phone', 'user_id', 'sex']);

        DB::table('player_rankings')->upsert([
            [
                'id' => '1',
                'player_id' => '1',
                'ranking_id' => '2',
            ]

        ], ['id'], ['player_id', 'ranking_id']);

        DB::table('players')->upsert([
            [
                'id' => '2',
                'name' => 'Eklent Kaci',
                'phone' => '0389999999',
                'user_id' => '2',
                'img' => 'eklent-kaci.webp',
                'sex' => 'Nam',

            ]

        ], ['id'], ['name', 'phone', 'user_id', 'sex']);

        DB::table('player_rankings')->upsert([
            [
                'id' => '1',
                'player_id' => '2',
                'ranking_id' => '1',
            ]

        ], ['id'], ['player_id', 'ranking_id']);

        DB::table('players')->upsert([
            [
                'id' => '3',
                'name' => 'Francisco Sanchez Ruiz',
                'phone' => '0389999999',
                'user_id' => '2',
                'img' => 'francisco-sanchez-ruiz.webp',
                'sex' => 'Nam',

            ]

        ], ['id'], ['name', 'phone', 'user_id', 'sex']);

        DB::table('player_rankings')->upsert([
            [
                'id' => '1',
                'player_id' => '3',
                'ranking_id' => '1',
            ]

        ], ['id'], ['player_id', 'ranking_id']);

        DB::table('players')->upsert([
            [
                'id' => '4',
                'name' => 'Jayson Shaw',
                'phone' => '0389999999',
                'user_id' => '2',
                'img' => 'Jayson-Shaw.png',
                'sex' => 'Nam',

            ]

        ], ['id'], ['name', 'phone', 'user_id', 'sex']);

        DB::table('player_rankings')->upsert([
            [
                'id' => '1',
                'player_id' => '4',
                'ranking_id' => '1',
            ]

        ], ['id'], ['player_id', 'ranking_id']);

        DB::table('players')->upsert([
            [
                'id' => '5',
                'name' => 'Ko Ping Chung',
                'phone' => '0389999999',
                'user_id' => '2',
                'img' => 'ko-ping-chung.webp',
                'sex' => 'Nam',

            ]

        ], ['id'], ['name', 'phone', 'user_id', 'sex']);

        DB::table('player_rankings')->upsert([
            [
                'id' => '1',
                'player_id' => '5',
                'ranking_id' => '1',
            ]

        ], ['id'], ['player_id', 'ranking_id']);

        DB::table('players')->upsert([
            [
                'id' => '6',
                'name' => 'Dương Quốc Hoàng',
                'phone' => '0389999999',
                'user_id' => '2',
                'img' => 'duong-quoc-hoang.jpeg',
                'sex' => 'Nam',

            ]

        ], ['id'], ['name', 'phone', 'user_id','sex']);

        DB::table('player_rankings')->upsert([
            [
                'id' => '1',
                'player_id' => '6',
                'ranking_id' => '9',
            ]

        ], ['id'], ['player_id', 'ranking_id']);

        DB::table('players')->upsert([
            [
                'id' => '7',
                'name' => 'Đăng Thành Kiên',
                'phone' => '0389999999',
                'user_id' => '2',
                'img' => 'dang-thanh-kien.jpeg',
                'sex' => 'Nam',

            ]

        ], ['id'], ['name', 'phone', 'user_id','sex']);

        DB::table('player_rankings')->upsert([
            [
                'id' => '1',
                'player_id' => '7',
                'ranking_id' => '2',
            ]

        ], ['id'], ['player_id', 'ranking_id']);
    }
}
