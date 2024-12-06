<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckAdminTournament
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Bạn vui lòng đăng nhập!');
        }

        if (Auth::user()->user_role->role_id !== 2) {
            return redirect()->route('ranking.tournament')->with('error', 'Bạn vui lòng sử dụng tài khoản đơn vị tổ chức giải!');
        }
        return $next($request);
    }
}
