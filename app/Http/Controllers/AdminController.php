<?php

namespace App\Http\Controllers;

use App\Models\Admin_tournament;
use App\Models\Player;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public static function index()
    {
        $players = Player::all();
        $admin_tournaments = Admin_tournament::all();
        $tournaments = Tournament::all();
        return view('admin/index', ['players' => $players, 'admin_tournaments' => $admin_tournaments, 'tournaments' => $tournaments]);
    }
    public static function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $dem = 0;
                foreach ($request->tournament_id as $id) {
                    $tournament = Tournament::find($id);
                    $tournament->status = $request->status[$dem];
                    $tournament->save();
                    $dem++;
                }
            });
            return redirect('/admin')->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect('/admin')->with('error', 'Cập nhật thất bại');
        }
    }
}
