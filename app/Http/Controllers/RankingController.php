<?php

namespace App\Http\Controllers;

use App\Models\Admin_tournament;
use App\Models\Player;
use App\Models\Tournament;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public static function index()
    {
        return view('home');
    }

    public static function ranking(Request $request)
    {
        $name = $request->input('name');
        $sex = $request->input('sex');
        $rankings = $request->input('rankings');

        $players = Player::get_top(1, 15, $name, $rankings, $sex);
        $players_top_5 = $players->slice(0, 5);
        $Player_top_6_from_15 = $players->slice(5, 15);
        return view('ranking', ['players_top_5' => $players_top_5, 'Player_top_6_from_15' => $Player_top_6_from_15]);
    }

    public static function detail($id)
    {
        $money = number_format(Player::get_money($id), 0, ',', '.') . ' VNĐ';
        $top = Player::get_top_player($id);
        $player = Player::get_detail($id);
        return view('detail-player', ['player' => $player, 'top' => $top, 'money' => $money]);
    }

    public function tournament_organizer()
    {
        $tournament_organizers = Admin_tournament::get_all();
        return view('tournament-organizer', ['tournament_organizers' => $tournament_organizers]);
    }

    public function tournament()
    {
        $tournaments = Tournament::get_all_apply();
        return view('tournament', ['tournaments' => $tournaments]);
    }

    public function register_tournament(Request $request)
    {
        $tournament_id = $request->route('tournament_id');
        session()->put('exampleModal', true);
        $tournaments = Tournament::get_all_apply();
        return view('tournament', ['tournaments' => $tournaments, 'tournament_id' => $tournament_id]);
    }
}
