<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminTournamentController extends Controller
{
    public static function index()
    {
        $admin_tournament = Auth::user()->admin_tournament;
        return view('adminTournament/index', ['admin_tournament' => $admin_tournament]);
    }
    public function get_add()
    {
        return view('adminTournament/add-tournament');
    }
}
