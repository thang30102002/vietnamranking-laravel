<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Tournament;

class RegisterTournament
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $tournament_id = $request->route('tournament_id');
        $tournament = Tournament::find($tournament_id);
        $check_ranking = false;
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn vui lòng đăng nhập!');
        }

        if (Auth::user()->user_role->role_id !== 3) {
            return redirect()->route('ranking.tournament')->with('error', 'Bạn vui lòng sử dụng tài khoản người chơi!');
        }
        foreach ($tournament->ranking_tournament as $ranking_tournament) {
            if (Auth::user()->player->player_ranking->ranking_id == $ranking_tournament->ranking_id) {
                $check_ranking = true;
            }
        }
        if ($check_ranking == false) {
            return redirect()->route('ranking.tournament')->with('error', 'Hạng của bạn không phù hợp để tham gia!');
        }
        return $next($request);
    }
}
