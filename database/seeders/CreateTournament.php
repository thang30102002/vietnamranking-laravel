<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CreateTournament extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->upsert([
            [
                'id' => '2',
                'email' => 'admintournament@gmail.com',
                'password' => '123123123',
            ]
        ], ['id'], ['email', 'password']);

        DB::table('user_roles')->upsert([
            [
                'id' => '2',
                'user_id' => '2',
                'role_id' => '2',
            ]
        ], ['id'], ['user_id', 'role_id']);

        DB::table('admin_tournaments')->upsert([
            [
                'id' => '1',
                'name' => 'The Billiards House',
                'information' => 'aaaaaaaaaaaaaaaaaaaaa',
                'phone' => '0388888888',
                'user_id' => '2',
            ]
        ], ['id'], ['name', 'information', 'phone', 'user_id']);

        DB::table('admin_tournaments')->upsert([
            [
                'id' => '2',
                'name' => 'The Billiards House',
                'information' => 'aaaaaaaaaaaaaaaaaaaaa',
                'phone' => '0388888888',
                'user_id' => '2',
            ]
        ], ['id'], ['name', 'information', 'phone', 'user_id']);

        DB::table('admin_tournaments')->upsert([
            [
                'id' => '3',
                'name' => 'The Billiards House',
                'information' => 'aaaaaaaaaaaaaaaaaaaaa',
                'phone' => '0388888888',
                'user_id' => '2',
            ]
        ], ['id'], ['name', 'information', 'phone', 'user_id']);

        DB::table('admin_tournaments')->upsert([
            [
                'id' => '4',
                'name' => 'The Billiards House',
                'information' => 'aaaaaaaaaaaaaaaaaaaaa',
                'phone' => '0388888888',
                'user_id' => '2',
            ]
        ], ['id'], ['name', 'information', 'phone', 'user_id']);

        DB::table('tournaments')->upsert([
            [
                'id' => '1',
                'name' => 'The Billiards House tournament',
                'number_players' => '32',
                'start_date' => '2024-11-20 15:30:00',
                'address' => '128 Nguyễn Huy Tưởng, Thanh Xuân, Hà Nội',
                'fees' => '150000',
                'status' => '1',
                'admin_tournament_id' => '1',
            ]
        ], ['id'], ['name', 'number_players', 'start_date', 'address', 'fees', 'status', 'admin_tournament_id']);

        DB::table('ranking_tournaments')->upsert([
            [
                'id' => '1',
                'tournament_id' => '1',
                'ranking_id' => '1',
            ],
            [
                'id' => '2',
                'tournament_id' => '1',
                'ranking_id' => '2',
            ],
            [
                'id' => '3',
                'tournament_id' => '1',
                'ranking_id' => '3',
            ]
        ], ['id'], ['tournament_id', 'ranking_id']);

        DB::table('tournament_top_moneys')->upsert([
            [
                'id' => '1',
                'tournament_id' => '1',
                'top' => '1',
                'money' => '3500000',
            ],
            [
                'id' => '2',
                'tournament_id' => '1',
                'top' => '2',
                'money' => '1000000',
            ],
            [
                'id' => '3',
                'tournament_id' => '1',
                'top' => '3',
                'money' => '500000',
            ]
        ], ['id'], ['tournament_id', 'top', 'money']);

        DB::table('tournament_game_types')->upsert([
            [
                'id' => '1',
                'tournament_id' => '1',
                'game_type_id' => '1',
            ]
        ], ['id'], ['tournament_id', 'game_type_id']);

        DB::table('player_registed_tournaments')->upsert([
            [
                'id' => '1',
                'tournament_id' => '1',
                'player_id' => '1',
            ]
        ], ['id'], ['tournament_id', 'player_id']);

        DB::table('achievements')->upsert([
            [
                'id' => '1',
                'player_id' => '1',
                'tournament_top_money_id' => '1',
            ],
            [
                'id' => '2',
                'player_id' => '2',
                'tournament_top_money_id' => '2',
            ],
            [
                'id' => '3',
                'player_id' => '4',
                'tournament_top_money_id' => '3',
            ],
            [
                'id' => '4',
                'player_id' => '3',
                'tournament_top_money_id' => '3',
            ],
            [
                'id' => '5',
                'player_id' => '5',
                'tournament_top_money_id' => '3',
            ],
            [
                'id' => '6',
                'player_id' => '6',
                'tournament_top_money_id' => '1',
            ],
            [
                'id' => '7',
                'player_id' => '7',
                'tournament_top_money_id' => '3',
            ],
        ], ['id'], ['player_id', 'tournament_top_money_id']);


        DB::table('tournaments')->upsert([
            [
                'id' => '2',
                'name' => 'Ốc sên ',
                'number_players' => '32',
                'start_date' => '2024-11-20 15:30:00',
                'address' => '128 Nguyễn Huy Tưởng, Thanh Xuân, Hà Nội',
                'fees' => '150000',
                'status' => '1',
                'admin_tournament_id' => '1',
            ]
        ], ['id'], ['name', 'number_players', 'start_date', 'address', 'fees', 'status', 'admin_tournament_id']);

        DB::table('ranking_tournaments')->upsert([
            [
                'id' => '4',
                'tournament_id' => '2',
                'ranking_id' => '1',
            ],
            [
                'id' => '5',
                'tournament_id' => '2',
                'ranking_id' => '2',
            ],
            [
                'id' => '6',
                'tournament_id' => '2',
                'ranking_id' => '3',
            ]
        ], ['id'], ['tournament_id', 'ranking_id']);

        DB::table('tournament_top_moneys')->upsert([
            [
                'id' => '4',
                'tournament_id' => '2',
                'top' => '1',
                'money' => '3500000',
            ],
            [
                'id' => '5',
                'tournament_id' => '2',
                'top' => '2',
                'money' => '1000000',
            ],
            [
                'id' => '6',
                'tournament_id' => '2',
                'top' => '3',
                'money' => '500000',
            ]
        ], ['id'], ['tournament_id', 'top', 'money']);

        DB::table('tournament_game_types')->upsert([
            [
                'id' => '2',
                'tournament_id' => '2',
                'game_type_id' => '2',
            ]
        ], ['id'], ['tournament_id', 'game_type_id']);
    }
}
