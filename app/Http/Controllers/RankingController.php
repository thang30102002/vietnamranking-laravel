<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;

class RankingController extends Controller
{
    public static function index()
    {
        return view('home');
    }
    public static function ranking()
    {
        $players_top_5 = Player::get_top(1,5);
        $Player_top_6_from_15 = Player::get_top(6,15);
        return view('ranking', ['players_top_5' => $players_top_5, 'Player_top_6_from_15' => $Player_top_6_from_15]);
    }
    public static function detail($id)
    {
        $player = Player::get_detail($id);
        return view('detail-player', compact('player'));
    }
}
