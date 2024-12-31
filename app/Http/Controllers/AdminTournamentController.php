<?php

namespace App\Http\Controllers;

use App\Models\Achievement;
use App\Models\Game_type;
use App\Models\Matches;
use App\Models\Ranking;
use App\Models\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\Player;
use App\Models\Player_money;
use App\Models\Player_ranking;
use App\Models\Player_registed_tournament;
use App\Models\Product;
use App\Models\Ranking_tournament;
use App\Models\Tournament_game_type;
use App\Models\Tournament_top_money;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

use function Pest\Laravel\swap;

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

    public function showEditTournament($id)
    {

        $game_types = Game_type::all();
        $rankings = Ranking::all();
        $tournament = Tournament::find($id);
        $player_registed = $tournament->player_registed_tournament;
        foreach ($tournament->ranking_tournament as $ranking_tournament) {
            $ranking_tournaments[] = $ranking_tournament->ranking_id;
        }
        $matches = Matches::where('tournament_id', $id)->get();

        return view('adminTournament/edit-tournament', ['tournament' => $tournament, 'game_types' => $game_types, 'rankings' => $rankings, 'ranking_tournaments' => $ranking_tournaments, 'player_registed' => $player_registed, 'matches' => $matches]);
    }

    public function editTournament($id, Request $request)
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
                //thay đổi thông tin giải đấu
                $tournament = Tournament::find($id);
                $tournament->name = $request->name;
                $tournament->number_players = $request->number_player;
                $tournament->start_date = $request->date_start;
                $tournament->address = $request->address;
                $tournament->fees = $request->fees;
                $tournament->tournament_end = $request->tournament_end;
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
                //////////////////////

                //cập nhật trạng thái đăng ký của cơ thủ và point
                $registed = $tournament->player_registed_tournament;
                for ($i = 0; $i < count($registed); $i++) {

                    $registed[$i]->status = $request->status[$i];
                    $registed[$i]->save();
                }
                ////////

                // Hàm cập nhật ranking của cơ thủ
                function update_ranking($id)
                {
                    $player = Player::find($id);
                    $point = $player->point;
                    switch (true) {
                        case ($point >= 50 && $point < 150):
                            // update hạng G
                            $player->player_ranking->ranking_id = 8;
                            break;

                        case ($point >= 150 && $point < 250):
                            // update hạng F
                            $player->player_ranking->ranking_id = 7;
                            break;

                        case ($point >= 250 && $point < 400):
                            // update hạng E
                            $player->player_ranking->ranking_id = 6;
                            break;

                        case ($point >= 400 && $point < 600):
                            // update hạng D
                            $player->player_ranking->ranking_id = 5;
                            break;

                        case ($point >= 600 && $point < 900):
                            // update hạng C
                            $player->player_ranking->ranking_id = 4;
                            break;

                        case ($point >= 900 && $point < 1200):
                            // update hạng B
                            $player->player_ranking->ranking_id = 3;
                            break;

                        case ($point >= 1200 && $point < 1500):
                            // update hạng A
                            $player->player_ranking->ranking_id = 2;
                            break;

                        case ($point >= 1500):
                            // update hạng CN
                            $player->player_ranking->ranking_id = 1;
                            break;

                        default:
                            // update hạng H
                            $player->player_ranking->ranking_id = 9;
                            break;
                    }
                    $player->player_ranking->save();
                }
                //cập nhật số tiền và hạng của cơ thủ khi giải đấu kết thúc
                if ($request->tournament_end == 2) {
                    //cập nhật ranking
                    $registeds = $tournament->player_registed_tournament;
                    foreach ($registeds as $registed) {
                        update_ranking($registed->player->id);
                    }
                    ////////

                    //cập nhật tiền thưởng
                    if ($request->top1 != null) {
                        $user = User::where('email', $request->top1)->first();
                        $top_1_Tournament = Tournament_top_money::where('tournament_id', $tournament->id)->where('top', 1)->first();
                        $achievement_top_1 = Achievement::where('tournament_top_money_id', $top_1_Tournament->id)->first();
                        if ($achievement_top_1) {
                            $achievement_top_1->delete();
                            $achievement_top_1->player->player_money->money = $achievement_top_1->player->player_money->money - $top_1_Tournament->money;
                            $achievement_top_1->player->player_money->save();
                            $achievement_top_1->player->save();
                            update_ranking($achievement_top_1->player->id);
                        }
                        $create_achievement_top_1 = Achievement::create([
                            'player_id' => $user->player->id,
                            'tournament_top_money_id' => $top_1_Tournament->id,
                        ]);
                        $create_achievement_top_1->player->player_money->money = $create_achievement_top_1->player->player_money->money + $top_1_Tournament->money;
                        $create_achievement_top_1->player->player_money->save();
                        // $create_achievement_top_1->player->point = $create_achievement_top_1->player->point + 400;
                        $create_achievement_top_1->player->save();
                        update_ranking($create_achievement_top_1->player->id);
                    }

                    if ($request->top2 != null) {
                        $user = User::where('email', $request->top2)->first();
                        $top_2_Tournament = Tournament_top_money::where('tournament_id', $tournament->id)->where('top', 2)->first();
                        $achievement_top_2 = Achievement::where('tournament_top_money_id', $top_2_Tournament->id)->first();
                        if ($achievement_top_2) {
                            $achievement_top_2->delete();
                            $achievement_top_2->player->player_money->money = $achievement_top_2->player->player_money->money - $top_2_Tournament->money;
                            $achievement_top_2->player->player_money->save();
                            $achievement_top_2->player->save();
                            update_ranking($achievement_top_2->player->id);
                        }
                        $create_achievement_top_2 = Achievement::create([
                            'player_id' => $user->player->id,
                            'tournament_top_money_id' => $top_2_Tournament->id,
                        ]);
                        $create_achievement_top_2->player->player_money->money = $create_achievement_top_2->player->player_money->money + $top_2_Tournament->money;
                        $create_achievement_top_2->player->player_money->save();
                        $create_achievement_top_2->player->save();
                        update_ranking($create_achievement_top_2->player->id);
                    }
                    // dd($request->top3[0]);
                    if ($request->top3 != null) {
                        if ($request->top3[0] != null || $request->top3[1] != null) {
                            $top_3_Tournament = Tournament_top_money::where('tournament_id', $tournament->id)->where('top', 3)->first();
                            $achievement_top_3s = Achievement::where('tournament_top_money_id', $top_3_Tournament->id)->get();
                            if ($achievement_top_3s) {
                                foreach ($achievement_top_3s as $achievement_top_3) {
                                    $achievement_top_3->delete();
                                    $achievement_top_3->player->player_money->money = $achievement_top_3->player->player_money->money - $top_3_Tournament->money;
                                    $achievement_top_3->player->player_money->save();

                                    $achievement_top_3->player->save();
                                    update_ranking($achievement_top_3->player->id);
                                }
                            }

                            foreach ($request->top3 as $top3) {
                                if ($top3 != null) {
                                    $user = User::where('email', $top3)->first();

                                    $create_achievement_top_3 = Achievement::create([
                                        'player_id' => $user->player->id,
                                        'tournament_top_money_id' => $top_3_Tournament->id,
                                    ]);
                                    $create_achievement_top_3->player->player_money->money = $create_achievement_top_3->player->player_money->money + $top_3_Tournament->money;
                                    $create_achievement_top_3->player->player_money->save();
                                    // $create_achievement_top_3->player->point = $create_achievement_top_3->player->point + 200;
                                    $create_achievement_top_3->player->save();
                                    update_ranking($create_achievement_top_3->player->id);
                                }
                            }
                        }
                    }
                    // // ///////

                    // //xoá giải thưởng nếu input giải thưởng bot trống
                    if ($request->top1 == null) {
                        $top_1_Tournament = Tournament_top_money::where('tournament_id', $tournament->id)->where('top', 1)->first();
                        $achievement_top_1 = Achievement::where('tournament_top_money_id', $top_1_Tournament->id)->first();
                        if ($achievement_top_1) {
                            $achievement_top_1->delete();
                            $achievement_top_1->player->player_money->money = $achievement_top_1->player->player_money->money - $top_1_Tournament->money;
                            $achievement_top_1->player->player_money->save();
                            $achievement_top_1->player->save();
                            update_ranking($achievement_top_1->player->id);
                        }
                    }
                    if ($request->top2 == null) {
                        $top_2_Tournament = Tournament_top_money::where('tournament_id', $tournament->id)->where('top', 2)->first();
                        $achievement_top_2 = Achievement::where('tournament_top_money_id', $top_2_Tournament->id)->first();
                        if ($achievement_top_2) {
                            $achievement_top_2->delete();
                            $achievement_top_2->player->player_money->money = $achievement_top_2->player->player_money->money - $top_2_Tournament->money;
                            $achievement_top_2->player->player_money->save();
                            $achievement_top_2->player->save();
                            update_ranking($achievement_top_2->player->id);
                        }
                    }
                    if ($request->top3 != null) {
                        if ($request->top3[0] == null && $request->top3[1] == null) {
                            $top_3_Tournament = Tournament_top_money::where('tournament_id', $tournament->id)->where('top', 3)->first();
                            $achievement_top_3s = Achievement::where('tournament_top_money_id', $top_3_Tournament->id)->get();
                            foreach ($achievement_top_3s as $achievement_top_3) {
                                $achievement_top_3->delete();
                                $achievement_top_3->player->player_money->money = $achievement_top_3->player->player_money->money - $top_3_Tournament->money;
                                $achievement_top_3->player->player_money->save();
                                $achievement_top_3->player->save();
                                update_ranking($achievement_top_3->player->id);
                            }
                        }
                    }
                    ////////
                }
                ///////////////////////

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

    public function showEditPlayer($id)
    {
        $top = Player::get_top_player($id);
        $player = Player::get_detail($id);
        $money = number_format($player->player_money->money, 0, ',', '.') . ' VNĐ';
        return view('adminTournament/update-profile-player', ['player' => $player, 'top' => $top, 'money' => $money]);
    }

    public function editPlayer($id, Request $request)
    {
        $request->validate([
            'cccd' => $request->cccd != null ? ['digits:12', 'unique:players,cccd'] : '',
            'cccd' => $request->cccd == null && $request->file('img') == null ? 'required' : '',
        ], [
            'cccd.digits' => 'Số căn cước công dân phải là số có 12 chữ số.',
            'cccd.unique' => 'Số căn cước công dân đã được sử dụng.',
            'cccd.required' => 'Điền thông tin muốn cập nhật.',

        ]);
        $player = Player::find($id);
        try {
            DB::transaction(function () use ($request, $player) {
                if ($request->file('img') != null) {
                    $fileName = $player->name . $player->id . '.' . $request->file('img')->extension();
                    $filePath = 'players' . $fileName;
                    // Lấy tất cả các file trong thư mục (không bao gồm thư mục con)
                    $files = Storage::disk('public')->files('players/' . $player->id);

                    // Xóa tất cả các file
                    foreach ($files as $file) {
                        Storage::disk('public')->delete($file);
                    }
                    // Lưu file ảnh
                    $file = $request->file('img');
                    $filePath = $file->storeAs('players/' . $player->id, $fileName, 'public');
                    $player->img = $fileName;
                    $player->save();
                }

                if ($request->cccd != null) {
                    // Cập nhật thông tin cơ thủ
                    $player->cccd = $request->cccd;
                    $player->save();
                }
            });

            // Thông báo thành công
            session()->flash('success', 'Cập nhật thông tin thành công!');
            return redirect()->route('adminTournament.editPlayer', ['id' => $id]);
        } catch (\Exception $e) {
            // Thông báo lỗi
            session()->flash('error', 'Cập nhật thông tin thất bại!');
            return redirect()->route('adminTournament.editPlayer', ['id' => $id]);
        }
    }
    function deleteDuplicateFiles($directory, $fileNameWithoutExtension)
    {
        // Lấy tất cả các tệp trong thư mục
        $files = Storage::files($directory);

        foreach ($files as $file) {
            // Lấy tên file không tính phần mở rộng
            $baseName = pathinfo($file, PATHINFO_FILENAME);

            // Kiểm tra nếu tên trùng
            if ($baseName === $fileNameWithoutExtension) {
                Storage::delete($file); // Xóa file
            }
        }
    }
    public function addMatches(Request $request)
    {
        $request->validate([
            'player_1' => ['required'],
            'player_2' => ['required'],
            'location' => ['required', 'integer'],
        ], [
            'player_1.required' => 'Vui lòng nhập email người chơi 1.',
            'player_2.required' => 'Vui lòng nhập email người chơi 2.',
            'location.required' => 'Vui lòng nhập số bàn thi đấu.',
            'location.integer' => 'Số bàn thi đấu phải là số nguyên.',
        ]);
        try {
            DB::transaction(function () {});
            $player_1 = User::where('email', $request->player_1)->first();
            $player_2 = User::where('email', $request->player_2)->first();
            $match = Matches::create([
                'tournament_id' => $request->tournament_id,
                'round' => $request->round,
                'player_id_1' => $player_1->player->id,
                'player_id_2' => $player_2->player->id,
                'location' => $request->location,
            ]);
            return back()->with('success', 'Thêm trận đấu thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Thêm trận đấu thất bại!');
        }
    }

    public function showEditMatches($id, $tournament_id)
    {
        $tournament = Tournament::find($tournament_id);
        $match = Matches::find($id);
        $player_1 = Player::find($match->player_id_1);
        $player_2 = Player::find($match->player_id_2);
        !empty($match->player_id_win) ? $player_win = Player::find($match->player_id_win) : '';
        $player_registed = $tournament->player_registed_tournament->where('status', 1);
        return view('adminTournament/edit-matches', ['match' => $match, 'tournament' => $tournament, 'player_registed' => $player_registed, 'player_1' => $player_1, 'player_2' => $player_2, 'player_win' => $player_win ?? null]);
    }

    public function editMatches(Request $request)
    {
        $request->validate([
            'player_1' => ['required'],
            'player_2' => ['required'],
            'player_win' => ['nullable', 'in:' . $request->player_1 . ',' . $request->player_2],  // Kiểm tra player_win phải trùng với player_1 hoặc player_2
            'location' => ['required', 'integer'],
            'point.*' => ['nullable', 'min:0'],
        ], [
            'player_1.required' => 'Vui lòng nhập email người chơi 1.',
            'player_2.required' => 'Vui lòng nhập email người chơi 2.',
            'location.required' => 'Vui lòng nhập số bàn thi đấu.',
            'location.integer' => 'Số bàn thi đấu phải là số nguyên.',
            'player_win.in' => 'Người chiến thắng phải là một trong hai người chơi.',
        ]);
        if ($request->player_win != null) {
            if ($request->point[0] == null ||  $request->point[1] == null) {
                return back()->withErrors([
                    'point' => 'Nếu trận đấu kết thúc cần nhập người chiến thắng và tỉ số trận đấu.',
                ]);
            }
        }
        if ($request->point[0] != null && $request->point[1] == null || $request->point[0] == null && $request->point[1] != null) {
            return back()->withErrors([
                'point' => 'Vui lòng nhập lại tỉ số trận đấu.',
            ]);
        }
        if ($request->point[0] != null && $request->point[1] != null) {
            if ($request->player_win == null) {
                return back()->withErrors([
                    'player_win' => 'Nếu trận đấu kết thúc cần nhập người chiến thắng và tỉ số trận đấu.',
                ]);
            }
            if ($request->point[0] == $request->point[1]) {
                return back()->withErrors([
                    'point' => 'Tỉ số trận đấu không được hòa.'
                ]);
            }
        }
        try {
            DB::transaction(function () {});
            $user_1 = User::where('email', $request->player_1)->first();
            $user_2 = User::where('email', $request->player_2)->first();
            if ($request->player_win != null) {
                $user_win = User::where('email', $request->player_win)->first();
            }
            $match = Matches::find($request->match_id);
            $match->player_id_1 = $user_1->player->id;
            $match->player_id_2 = $user_2->player->id;
            $match->location = $request->location;
            if ($request->player_win != null) {
                $match->player_id_win = $user_win->player->id;
                $match->point_1 = $request->point[0];
                $match->point_2 = $request->point[1];
                $user_win->player->point = $user_win->player->point + 13;
                $user_win->player->save();
                if ($user_win->id == $user_1->id) {
                    $user_2->player->point = $user_2->player->point - 10;
                    $user_2->player->save();
                } else {
                    $user_1->player->point = $user_1->player->point - 10;
                    $user_1->player->save();
                }
            }
            $match->round = $request->round;
            $match->save();
            return redirect(route('adminTournament.showEditTournament', ['id' => $request->tournament_id]))->with('success', 'Cập nhật trận đấu thành công!');
        } catch (\Exception $e) {
            return redirect(route('adminTournament.showEditTournament', ['id' => $request->tournament_id]))->with('error', 'Cập nhật trận đấu thất bại!');
        }
    }

    public function deleteMatch(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $match = Matches::find($request->match_id);
                if ($match->player_id_win != null) {
                    $player_win = Player::find($match->player_id_win);
                    $player_1 = Player::find($match->player_id_1);
                    $player_2 = Player::find($match->player_id_2);
                    $player_win->point = $player_win->point - 13;
                    $player_win->save();
                    if ($player_win->id == $player_1->id) {
                        $player_2->point = $player_2->point + 10;
                        $player_2->save();
                    } else {
                        $player_1->point = $player_1->point + 10;
                        $player_1->save();
                    }
                }
                $match->delete();
            });
            return back()->with('success', 'Xoá trận đấu thành công!');
        } catch (\Exception $e) {
            return back()->with('error', 'Xoá trận đấu thất bại!');
        }
    }
}
