<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory, Notifiable;
use Illuminate\Support\Facades\DB;

class Player extends Model
{

    protected $fillable = [
        'name',
        'phone',
        'created_at',
        'updated_at',
        'img',
        'user_id',
    ];

    public static function get_all()
    {
        $players = self::all();
        return $players;
    }

    public static function get_detail($id)
    {
        $player = self::find($id);
        return $player;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function achievement()
    {
        return $this->hasMany(Achievement::class, 'player_id');
    }
    public function get_achievement($id)
    {
        $player = self::find($id);
        $achievement = $player->achievement;
        return $achievement;
    }

    public static function get_money($id)
    {
        $player = self::find($id);
        $money = 0;
        for ($i = 0; $i < count($player->achievement); $i++) {
            $money = $money + $player->achievement[$i]->tournament_top_money->money;
        }
        return $money;
    }

    public static function get_top($from, $to)
    {
        $players = Player::select('players.*', DB::raw('SUM(tournament_top_moneys.money) as total_money'))
            ->join('achievements', 'players.id', '=', 'achievements.player_id')
            ->join('tournament_top_moneys', 'achievements.tournament_top_money_id', '=', 'tournament_top_moneys.id')
            ->groupBy('players.id', 'players.name', 'players.phone', 'players.img', 'players.created_at', 'players.updated_at', 'players.user_id')
            ->orderBy('total_money', 'desc')
            ->offset($from - 1)
            ->limit($to - $from + 1)
            ->get();
        return $players;
    }
}
