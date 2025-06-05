<?php

namespace App\Http\Controllers;

use App\Models\Admin_tournament;
use App\Models\Matches;
use App\Models\Player;
use App\Models\Player_registed_tournament;
use App\Models\Player_register_tournament;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Notifications\TournamentNotification;

class RankingController extends Controller
{
    public static function index()
    {
        $tournaments_apply = Tournament::get_all_apply();
        $players = Player::get_top(1, 4, null, null, null, null);
        return view('home', ['players_top_4' => $players, 'tournaments_apply' => $tournaments_apply]);
    }

    public static function ranking(Request $request)
    {
        $name = $request->input('name');
        $sex = $request->input('sex');
        $rankings = $request->input('rankings');
        $phone = $request->input('phone');
        $players = Player::get_top(1, 15, $name, $rankings, $sex, $phone);
        $players_top_5 = $players->slice(0, 5);
        $Player_top_6_from_15 = $players->slice(5, 15);
        return view('ranking', ['players_top_5' => $players_top_5, 'Player_top_6_from_15' => $Player_top_6_from_15]);
    }

    public static function detail($id)
    {
        $top = Player::get_top_player($id);
        $player = Player::get_detail($id);
        $money = number_format($player->player_money->money, 0, ',', '.') . ' VNĐ';
        $matches = Matches::where('player_id_1', $id)
            ->orWhere('player_id_2', $id)
            ->get();
        return view('detail-player', ['player' => $player, 'top' => $top, 'money' => $money, 'matches' => $matches]);
    }

    public function tournament_organizer()
    {
        $tournament_organizers = Admin_tournament::get_all();
        return view('tournament-organizer', ['tournament_organizers' => $tournament_organizers]);
    }

    public function tournament()
    {
        $tournaments = Tournament::get_all_apply();
        $tournaments_taking_place = Tournament::get_all_taking_place();
        $tournaments_took_place = Tournament::get_all_took_place();
        return view('tournament', ['tournaments' => $tournaments, 'tournaments_taking_place' => $tournaments_taking_place, 'tournaments_took_place' => $tournaments_took_place]);
    }

    public function register_tournament(Request $request)
    {
        $tournament_id = $request->route('tournament_id');
        session()->put('exampleModal', true);
        $tournaments = Tournament::get_all_apply();
        return view('tournament', ['tournaments' => $tournaments, 'tournament_id' => $tournament_id]);
    }

    public function register_tournament_success(Request $request)
    {
        $count = Player_registed_tournament::where('tournament_id', $request->tournament_id)
            ->where('player_id', $request->player_id)
            ->count();

        if ($count == 0) {
            $player_register = Player_registed_tournament::create([
                'tournament_id' => $request->tournament_id,
                'player_id' => $request->player_id,
            ]);
            if ($player_register) {
                // $player_register->player->user->notify(new TournamentNotification($player_register->tournament, TournamentNotification::TOURNAMENT_TYPE['register']));
                return redirect('/tournament')->with('success', "Đơn đăng ký đã được ghi nhận");
            } else {
                return redirect('/tournament')->with('error', "Đăng ký không thành công");
            }
        } else {
            return redirect('/tournament')->with('error', "Đăng ký không thành công. Có vẻ như bạn đã đăng ký giải đấu này trước đó");
        }
    }

    public function change_password(Request $request)
    {
        $request->validate([
            'password' => ['required', 'confirmed', Password::defaults(), 'min:8'],
        ], [
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.confirmed' => 'Vui lòng xác nhận lại mật khẩu.',
            'password.min' => 'Mật khẩu ít nhất phải có 8 kí tự.',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $user = auth()->user();
                $user->password = Hash::make($request->password);
                $user->save();
            });
            return back()->with('success', 'Mật khẩu đã được cập nhật thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Cập nhật mật khẩu thất bại!');
        }
    }

    public function tournament_bracket($tournamentId)
    {
        $tournament = Tournament::find($tournamentId);
        $player_registed = $tournament->player_registed_tournament->where('status', 1);
        $players = $player_registed->pluck('player.name')->toArray();
        $teams = null;
        for ($i = 0; $i < count($players); $i += 2) {
            $team1 = $players[$i] ?? null;
            $team2 = $players[$i + 1] ?? null;
            $teams[] = [$team1, $team2];
        }
        $bracket_data = $tournament->bracket;
        return view('tournament-bracket', ['tournament' => $tournament, 'teams' => $teams, 'bracket_data' => $bracket_data]);
    }
}

