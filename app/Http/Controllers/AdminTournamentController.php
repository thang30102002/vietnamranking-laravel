<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Game_type;
use App\Models\Ranking;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Player_money;
use App\Models\Player_registed_tournament;
use App\Models\Product;
use App\Models\Ranking_tournament;
use App\Models\Tournament_game_type;
use App\Models\Tournament_top_money;
use App\Models\User;

class AdminTournamentController extends Controller
{
    public static function index()
    {
        $admin_tournament = Auth::user()->admin_tournament;
        return view('adminTournament/index', ['admin_tournament' => $admin_tournament]);
    }

    public function get_add()
    {
        $game_types = Game_type::all();
        $rankings = Ranking::all();
        return view('adminTournament/add-tournament', ['game_types' => $game_types, 'rankings' => $rankings]);
    }

    public function add_tournament(Request $request)
    {
        $request->validate([
            'name' => ['required'],
            'type' => 'required',
            'number_player' => ['required', 'integer'],
            'date_start' => ['required', 'date'],
            'address' => 'required',
            'fees' => ['required', 'integer'],
            'money_top_1' => ['required', 'integer'],
            'money_top_2' => ['required', 'integer'],
            'money_top_3' => ['required', 'integer'],
            'ranking' => 'required',
        ], [
            'name.required' => 'Vui lòng nhập tên giải đấu.',
            'type.required' => 'Vui lòng chọn loại giải đấu.',
            'number_player.required' => 'Vui lòng nhập số lượng người chơi.',
            'number_player.integer' => 'Số lượng người chơi phải là số nguyên.',
            'date_start.required' => 'Vui lòng chọn ngày bắt đầu.',
            'date_start.date' => 'Ngày bắt đầu phải là một định dạng ngày hợp lệ.',
            'address.required' => 'Vui lòng nhập địa chỉ tổ chức giải đấu.',
            'fees.required' => 'Vui lòng nhập phí tham gia giải đấu.',
            'fees.integer' => 'Phí tham gia phải là số nguyên.',
            'money_top_1.required' => 'Vui lòng nhập tiền thưởng cho quán quân.',
            'money_top_1.integer' => 'Tiền thưởng phải là số nguyên.',
            'money_top_2.required' => 'Vui lòng nhập tiền thưởng cho á quân.',
            'money_top_2.integer' => 'Tiền thưởng phải là số nguyên.',
            'money_top_3.required' => 'Vui lòng nhập tiền thưởng cho hạng 3.',
            'money_top_3.integer' => 'Tiền thưởng phải là số nguyên.',
            'ranking.required' => 'Vui lòng chọn hạng có thể tham gia.',
        ]);
        try {
            DB::transaction(function () use ($request) {
                $tournament = Tournament::create([
                    'name' => $request->name,
                    'number_players' => $request->number_player,
                    'start_date' => $request->date_start,
                    'address' => $request->address,
                    'fees' => $request->fees,
                    'status' => 0,
                    'admin_tournament_id' => Auth::user()->admin_tournament->id,
                ]);

                $tournament_type = Tournament_game_type::create([
                    'tournament_id' => $tournament->id,
                    'game_type_id' => $request->input('type'),
                ]);

                $tournament_top_money = Tournament_top_money::create([
                    'tournament_id' => $tournament->id,
                    'top' => 1,
                    'money' => $request->input('money_top_1'),
                ]);

                $tournament_top_money = Tournament_top_money::create([
                    'tournament_id' => $tournament->id,
                    'top' => 2,
                    'money' => $request->input('money_top_2'),
                ]);

                $tournament_top_money = Tournament_top_money::create([
                    'tournament_id' => $tournament->id,
                    'top' => 3,
                    'money' => $request->input('money_top_3'),
                ]);

                $rankings = $request->input('ranking');
                foreach ($rankings as $ranking) {
                    $tournament_ranking = Ranking_tournament::create([
                        'tournament_id' => $tournament->id,
                        'ranking_id' => $ranking,
                    ]);
                }
            });
            session()->flash('success', 'Tạo giải đấu thành công!');
            return redirect('/adminTournament/tournaments');
        } catch (\Exception $e) {
            session()->flash('error', 'Tạo giải đấu thất bại!');
            return redirect('/adminTournament/add_tournament');
        }
    }

    public static function showAllTournament()
    {
        $tournaments = Auth::user()->admin_tournament->tournament;
        return view('adminTournament/all-tournaments', ['tournaments' => $tournaments]);
    }

    public function destroy($id)
    {
        $tournament = Tournament::find($id);

        if (!$tournament) {
            return redirect()->route('adminTournament.showAllTournament')->with('error', 'Giải đấu không tồn tại!');
        }

        $tournament->delete();

        return redirect()->route('adminTournament.showAllTournament')->with('success', 'Xoá giải đấu thành công!');
    }

    public function showEditTournament($id, Request $request)
    {

        $game_types = Game_type::all();
        $rankings = Ranking::all();
        $tournament = Tournament::find($id);
        $player_registed = $tournament->player_registed_tournament;
        foreach ($tournament->ranking_tournament as $ranking_tournament) {
            $ranking_tournaments[] = $ranking_tournament->ranking_id;
        }
        return view('adminTournament/edit-tournament', ['tournament' => $tournament, 'game_types' => $game_types, 'rankings' => $rankings, 'ranking_tournaments' => $ranking_tournaments, 'player_registed' => $player_registed]);
    }

    public function editTournament($id, Request $request)
    {
        // dd($request->top3);
        $request->validate([
            'name' => ['required'],
            'type' => 'required',
            'number_player' => ['required', 'integer'],
            'date_start' => ['required', 'date'],
            'address' => 'required',
            'fees' => ['required', 'integer'],
            'money_top_1' => ['required', 'integer'],
            'money_top_2' => ['required', 'integer'],
            'money_top_3' => ['required', 'integer'],
            'ranking' => 'required',
            'email' => ['string', 'lowercase', 'email', 'max:255'],
        ], [
            'name.required' => 'Vui lòng nhập tên giải đấu.',
            'type.required' => 'Vui lòng chọn loại giải đấu.',
            'number_player.required' => 'Vui lòng nhập số lượng người chơi.',
            'number_player.integer' => 'Số lượng người chơi phải là số nguyên.',
            'date_start.required' => 'Vui lòng chọn ngày bắt đầu.',
            'date_start.date' => 'Ngày bắt đầu phải là một định dạng ngày hợp lệ.',
            'address.required' => 'Vui lòng nhập địa chỉ tổ chức giải đấu.',
            'fees.required' => 'Vui lòng nhập phí tham gia giải đấu.',
            'fees.integer' => 'Phí tham gia phải là số nguyên.',
            'money_top_1.required' => 'Vui lòng nhập tiền thưởng cho quán quân.',
            'money_top_1.integer' => 'Tiền thưởng phải là số nguyên.',
            'money_top_2.required' => 'Vui lòng nhập tiền thưởng cho á quân.',
            'money_top_2.integer' => 'Tiền thưởng phải là số nguyên.',
            'money_top_3.required' => 'Vui lòng nhập tiền thưởng cho hạng 3.',
            'money_top_3.integer' => 'Tiền thưởng phải là số nguyên.',
            'ranking.required' => 'Vui lòng chọn hạng có thể tham gia.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
        ]);
        try {
            DB::transaction(function () use ($request, $id) {
                $tournament = Tournament::find($id);
                $tournament->name = $request->name;
                $tournament->number_players = $request->number_player;
                $tournament->start_date = $request->date_start;
                $tournament->address = $request->address;
                $tournament->fees = $request->fees;
                $tournament->save();

                $tournament_game_type = Tournament_game_type::find($tournament->tournament_game_type->id);
                $tournament_game_type->game_type_id = $request->type;
                $tournament_game_type->save();

                $top_money = $tournament->tournament_top_money;
                $top_money_1 = Tournament_top_money::find($top_money[0]->id);
                $top_money_1->money = $request->money_top_1;
                $top_money_1->save();

                $top_money_2 = Tournament_top_money::find($top_money[1]->id);
                $top_money_2->money = $request->money_top_2;
                $top_money_2->save();

                $top_money_3 = Tournament_top_money::find($top_money[2]->id);
                $top_money_3->money = $request->money_top_3;
                $top_money_3->save();

                $input_rankings = $request->ranking;
                $rankings = $tournament->ranking_tournament;
                for ($i = 0; $i < count($rankings); $i++) {
                    $set_ranking = Ranking_tournament::find($rankings[$i]->id);
                    $set_ranking->ranking_id = $input_rankings[$i];
                    $set_ranking->save();
                }

                $registed = $tournament->player_registed_tournament;
                for ($i = 0; $i < count($registed); $i++) {
                    if ($registed[$i]->status == 0 && $request->status[$i] == 1) {
                        $registed[$i]->player->player_money->money = $registed[$i]->player->player_money->money - $registed[$i]->tournament->fees - 200000;
                        $registed[$i]->player->player_money->save();
                    }

                    if ($registed[$i]->status == 1 && $request->status[$i] == 0) {
                        $registed[$i]->player->player_money->money = $registed[$i]->player->player_money->money + $registed[$i]->tournament->fees - 200000;
                        $registed[$i]->player->player_money->save();
                    }

                    $registed[$i]->status = $request->status[$i];
                    $registed[$i]->save();
                }

                // Hàm xử lý cập nhật Achievement và Player_money
                function updateTopAchievement($top, $tournamentId, $userEmail, $money)
                {
                    // Lấy Tournament_top_money theo top
                    $topTournament = Tournament_top_money::where('tournament_id', $tournamentId)->where('top', $top)->first();
                    $user = User::where('email', $userEmail)->first();

                    if ($topTournament && $user) {
                        // Kiểm tra Achievement tồn tại
                        $achievement = Achievement::where('tournament_top_money_id', $topTournament->id)->first();

                        if ($achievement) {
                            // Lấy player_id cũ và trừ tiền người cũ
                            $oldPlayerId = $achievement->player_id;
                            $oldPlayerMoney = Player_money::where('player_id', $oldPlayerId)->first();
                            if ($oldPlayerMoney) {
                                $oldPlayerMoney->money -= $money;
                                $oldPlayerMoney->save();
                            }

                            // Cập nhật Achievement sang người mới
                            $achievement->update([
                                'player_id' => $user->player->id,
                            ]);
                        } else {
                            // Nếu chưa tồn tại, tạo mới Achievement
                            Achievement::create([
                                'player_id' => $user->player->id,
                                'tournament_top_money_id' => $topTournament->id,
                            ]);
                        }

                        // Cộng tiền cho người mới
                        $newPlayerMoney = Player_money::where('player_id', $user->player->id)->first();
                        if ($newPlayerMoney) {
                            $newPlayerMoney->money += $money;
                            $newPlayerMoney->save();
                        } else {
                            // Nếu chưa có Player_money, tạo mới
                            Player_money::create([
                                'player_id' => $user->player->id,
                                'money' => $money,
                            ]);
                        }
                    }
                }

                // Gọi hàm xử lý cho top1
                if ($request->top1 != null) {
                    updateTopAchievement(1, $id, $request->top1, Tournament_top_money::where('tournament_id', $id)->where('top', 1)->value('money'));
                }

                // Gọi hàm xử lý cho top2
                if ($request->top2 != null) {
                    updateTopAchievement(2, $id, $request->top2, Tournament_top_money::where('tournament_id', $id)->where('top', 2)->value('money'));
                }


                // dd($request->top3);
                if ($request->top3 != null) {
                    $top3_tournament = Tournament_top_money::where('tournament_id', $id)->where('top', 3)->first();

                    if ($top3_tournament) {
                        $achievement_top3s = Achievement::where('tournament_top_money_id', $top3_tournament->id)->get();

                        // Xóa dữ liệu cũ và cập nhật tiền cho người chơi cũ
                        foreach ($achievement_top3s as $achievement_top3) {
                            $player = $achievement_top3->player;
                            if ($player && $player->player_money) {
                                $player->player_money->money -= $top3_tournament->money;
                                $player->player_money->save();
                            }
                            $achievement_top3->delete();
                        }

                        // Thêm dữ liệu mới
                        $emails = $request->top3;
                        foreach ($emails as $email) {
                            $user = User::where('email', $email)->first();

                            if ($user && $user->player && $user->player->player_money) {
                                Achievement::create([
                                    'player_id' => $user->player->id,
                                    'tournament_top_money_id' => $top3_tournament->id,
                                ]);

                                $user->player->player_money->money += $top3_tournament->money;
                                $user->player->player_money->save();
                            }
                        }
                    }
                }
            });
            return back()->with('success', 'Thao tác thành công!');
        } catch (\Exception $e) {
            return redirect()->route('adminTournament.showEditTournament', ['id' => $id])->with('error', 'Chỉnh sửa giải đấu không thành công!');
        }
    }

    public function profile()
    {
        $admin_tournament = Auth::user()->admin_tournament;
        return view('adminTournament/profile', ['admin_tournament' => $admin_tournament]);
    }
}
