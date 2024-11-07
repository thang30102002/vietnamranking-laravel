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
        $players = Player::get_all();
        return view('ranking',compact('players'));
    }
    public static function detail($id)
    {
        $player = Player::get_detail($id);
        return view('detail-player', compact('player'));
    }
}
