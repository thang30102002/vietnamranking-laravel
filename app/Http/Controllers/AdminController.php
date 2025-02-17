<?php

namespace App\Http\Controllers;

use App\Models\Admin_tournament;
use App\Models\Player;
use App\Models\Tournament;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public static function index(Request $request)
    {
        $search = $request->query('search');
        $players = Player::all();
        $admin_tournaments = Admin_tournament::all();
        $tournaments = Tournament::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('start_date', 'like', "%{$search}%");
        })->paginate(10);
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

    public static function showUser(Request $request)
    {
        $search = $request->query('search');
        $users = User::whereHas('user_role', function ($query) {
            $query->where('role_id', 3);
        })
            ->when($search, function ($query, $search) {
                return $query->where('email', 'like', "%{$search}%")
                    ->orWhereHas('player', function ($query) use ($search) {
                        $query->where('name', 'like', "%{$search}%")
                            ->orWhere('phone', 'like', "%{$search}%");
                    });
            })
            ->paginate(5);

        return view('admin/users', ['users' => $users]);
    }

    public static function showEditUser($id)
    {
        $user = User::find($id);
        return view('admin/showEdit', ['user' => $user]);
    }

    public static function updatePlayer(Request $request, $id)
    {
        $user = User::find($id);
        $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'password' => ['required', 'min:8'],
            'phone' => ['required', 'regex:/^[0-9]{10}$/', 'unique:players,phone,' . $user->player->id],
            'point' => ['required', 'numeric'],
            'cccd' => $request->cccd != null ? ['digits:12', 'unique:players,cccd,' . $user->player->id] : '',
        ], [
            'name.required' => 'Vui lòng nhập tên cơ thủ.',
            'email.required' => 'Vui lòng nhập email.',
            'email.email' => 'Vui lòng nhập đúng định dạng email.',
            'password.required' => 'Vui lòng nhập mật khẩu mới.',
            'password.min' => 'Mật khẩu ít nhất phải có 8 kí tự.',
            'phone.regex' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'phone.unique' => 'Số điện thoại đã được sử dụng',
            'point.required' => 'Vui lòng nhập point',
            'point.numeric' => 'Point phải là số',
            'cccd.digits' => 'Số căn cước công dân phải là số có 12 chữ số.',
            'cccd.unique' => 'Số căn cước công dân đã được sử dụng.',
        ]);
        try {
            DB::transaction(function () use ($request, $user) {

                if ($request->img != null) {
                    $fileName = $user->player->name . $user->player->id . '.' . $request->file('img')->extension();
                    $filePath = 'players' . $fileName;
                    // Lấy tất cả các file trong thư mục (không bao gồm thư mục con)
                    $files = Storage::disk('public')->files('players/' . $user->player->id);

                    // Xóa tất cả các file
                    foreach ($files as $file) {
                        Storage::disk('public')->delete($file);
                    }
                    // Lưu file ảnh
                    $file = $request->file('img');
                    $filePath = $file->storeAs('players/' . $user->player->id, $fileName, 'public');
                    $user->player->img = $fileName;
                }

                if ($request->cccd != null) {
                    // Cập nhật thông tin cơ thủ
                    $user->player->cccd = $request->cccd;
                }
                $user->player->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->player->phone = $request->phone;
                $user->player->point = $request->point;
                $user->player->cccd = $request->cccd;
                $user->save();
                $user->player->save();

                updateRanking($user->player->id);
            });
            return redirect('/admin/edit-player/' . $id)->with('success', 'Cập nhật thành công');
        } catch (\Exception $e) {
            return redirect('/admin/edit-player/' . $id)->with('error', 'Cập nhật thất bại');
        }
    }

    public static function deletePlayer(Request $request)
    {
        $user = User::find($request->match_id);
        try {
            DB::transaction(function () use ($user) {
                $user->delete();
            });
            return redirect('/admin/users')->with('success', 'Xóa thành công');
        } catch (\Exception $e) {
            return redirect('/admin/users')->with('error', 'Xóa thất bại');
        }
    }
}
