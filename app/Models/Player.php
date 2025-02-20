<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory, Notifiable;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class Player extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'sex',
        'user_id',
        'point',
    ];

    public function player_registed_tournament()
    {
        return $this->hasMany(Player_registed_tournament::class);
    }

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

    public static function get_top($from, $to, $name = null, $rankings = [], $sex = [], $phone = null)
    {
        $query = Player::select(
            'players.id',
            'players.name',
            'players.phone',
            'players.img',
            'players.created_at',
            'players.updated_at',
            'players.user_id',
            'players.sex',
            'players.point',
            'player_moneys.money'
        )
            ->join('player_moneys', 'players.id', '=', 'player_moneys.player_id')
            ->join('player_rankings', 'players.id', '=', 'player_rankings.player_id')
            ->groupBy(
                'players.id',
                'players.name',
                'players.phone',
                'players.img',
                'players.created_at',
                'players.updated_at',
                'players.user_id',
                'players.sex', // Thêm cột này vào GROUP BY
                'players.point',
                'player_moneys.money'
            )
            ->orderBy('player_moneys.money', 'desc')
            ->orderBy('players.id', 'desc');

        if (!is_null($phone)) {
            $query->where('players.phone', '=', $phone);
        }

        if (!is_null($name)) {
            $query->where('players.name', '=', $name);
        }

        if ($sex == "Nam" || $sex == "Nữ") {
            $query->where('players.sex', $sex);
        }

        if (!empty($rankings)) {
            $query->whereIn('player_rankings.ranking_id', $rankings);
        }

        // Giới hạn kết quả
        $query->offset($from - 1)->limit($to - $from + 1);

        // Lấy kết quả
        return $query->get();
    }

    public static function get_top_player($id)
    {
        $players = Player::select(
            'players.id',
            'players.name',
            'players.phone',
            'players.img',
            'players.created_at',
            'players.updated_at',
            'players.user_id',
            'players.sex',
            'players.point',
            'player_moneys.money'
        )
            ->join('player_moneys', 'players.id', '=', 'player_moneys.player_id')
            ->join('player_rankings', 'players.id', '=', 'player_rankings.player_id')
            ->groupBy(
                'players.id',
                'players.name',
                'players.phone',
                'players.img',
                'players.created_at',
                'players.updated_at',
                'players.user_id',
                'players.sex', // Thêm cột này vào GROUP BY
                'players.point',
                'player_moneys.money'
            )
            ->orderBy('player_moneys.money', 'desc')
            ->orderBy('players.id', 'desc')->get();
        $top = 0;
        foreach ($players as $player) {
            $top = $top + 1;
            if ($player->id == $id) {
                break;
            }
        }
        return $top;
    }

    public function player_ranking()
    {
        return $this->hasOne(Player_ranking::class);
    }

    public function player_money()
    {
        return $this->hasOne(Player_money::class);
    }

    public function matches()
    {
        return $this->hasMany(Matches::class);
    }
}
