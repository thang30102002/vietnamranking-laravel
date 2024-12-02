<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory, Notifiable;
use Illuminate\Support\Facades\DB;

class Player extends Model
{

    // protected $fillable = [
    //     'name',
    //     'phone',
    //     'created_at',
    //     'updated_at',
    //     'img',
    //     'user_id',
    // ];

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
        return $this->hasMany(Achievement::class);
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
        foreach ($player->achievement as $achievement) {
            $money = $money + $achievement->tournament_top_money->money;
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
            // ->where('players.sex', '=', 'Nữ')    
            ->get();
        return $players;
    }

    public static function get_top_player($id)
    {
        $players = Player::select('players.*', DB::raw('SUM(tournament_top_moneys.money) as total_money'))
            ->join('achievements', 'players.id', '=', 'achievements.player_id')
            ->join('tournament_top_moneys', 'achievements.tournament_top_money_id', '=', 'tournament_top_moneys.id')
            ->groupBy('players.id', 'players.name', 'players.phone', 'players.img', 'players.created_at', 'players.updated_at', 'players.user_id')
            
            ->orderBy('total_money', 'desc')
            
            ->get();

        $top = 0;
        foreach ($players as $player) {
            $top = $top + 1;
            if($player->id == $id)
            {
                break;
            }
        }
        return $top;
    }

    public function player_ranking()
    {
        return $this->hasOne(Player_ranking::class);
    }
}
