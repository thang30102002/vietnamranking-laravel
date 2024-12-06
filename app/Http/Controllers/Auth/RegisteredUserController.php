<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin_tournament;
use App\Models\Player;
use App\Models\Player_money;
use App\Models\Player_ranking;
use App\Models\Ranking;
use App\Models\User;
use App\Models\User_role;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults(), 'min:8'],
            'phone' => ['required', 'regex:/^[0-9]{10}$/'],
            'rank' => $request->user_type == 2 ? 'required' : 'nullable',
            'user_type' => 'required',
            'info' => $request->user_type == 1 ? 'required|string|max:255' : 'nullable',
            'sex' => $request->user_type == 2 ? 'required' : 'nullable',
        ], [
            'name.required' => 'Vui lòng nhập họ và tên',
            'name.string' => 'Vui lòng nhập đúng định dạng họ và tên',
            'name.max' => 'Họ và tên không được vượt quá 255 kí tự',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email đã được sử dụng',
            'email.email' => 'Vui lòng nhập đúng định dạng email VD: admin@gmail.com',
            'phone.regex' => 'Vui lòng nhập đúng định dạng số điện thoại',
            'phone.required' => 'Vui lòng nhập số điện thoại',
            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Vui lòng xác thực lại mật khẩu',
            'password.min' => 'Mật khẩu phải ít nhất 8 kí tự',
            'rank.required' => 'Vui lòng chọn thứ hạng',
            'sex.required' => 'Vui lòng chọn giới tính',
            'user_type.required' => 'Vui lòng chọn loại tài khoản',
            'info.required' => 'Vui lòng điền một số thông tin về đơn vị tổ chức',

        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        if ($request->user_type == 2) {
            $player = Player::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'sex' => $request->sex,
                'user_id' => $user->id,
            ]);
            if ($player) {
                $userRole = User_role::create([
                    'user_id' => $user->id,
                    'role_id' => 3,
                ]);

                $player_ranking = Player_ranking::create([
                    'player_id' => $player->id,
                    'ranking_id' => $request->rank,
                ]);

                $player_money = Player_money::create([
                    'player_id' => $player->id,
                    'money' => 0,
                ]);
            }
        } else {
            $admin_tournament = Admin_tournament::create([
                'name' => $request->name,
                'information' => $request->info,
                'phone' => $request->phone,
                'user_id' => $user->id,
            ]);
            if ($admin_tournament) {
                $userRole = User_role::create([
                    'user_id' => $user->id,
                    'role_id' => 2,
                ]);
            }
        }




        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
