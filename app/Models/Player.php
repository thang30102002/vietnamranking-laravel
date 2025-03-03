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
    //point
    const POINT = [
        'K' => 0,
        'K+' => 5,
        'I' => 10,
        'I+' => 15,
        'H' => 20,
        'H+' => 25,
        'G' => 30,
        'G+' => 35,
        'F' => 40,
        'F+' => 45,
        'E' => 50,
        'E+' => 55,
        'D' => 60,
        'D+' => 65,
        'C' => 70,
        'C+' => 75,
        'B' => 80,
        'B+' => 85,
        'A' => 90,
        'A+' => 95,
        'CN' => 100,
    ];

    //point_ranking
    const POINT_RANKING =[
        0 => 1,
        5 => 2,
        10 => 3,
        15 => 4,
        20 => 5,
        25 => 6,
        30 => 7,
        35 => 8,
        40 => 9,
        45 => 10,
        50 => 11,
        55 => 12,
        60 => 13,
        65 => 14,
        70 => 15,
        75 => 16,
        80 => 17,
        85 => 18,
        90 => 19,
        95 => 20,
        100 => 21,
    ];

    //ranking
    const RANKING = [
        1 => 'K',
        2 => 'K+',
        3 => 'I',
        4 => 'I+',
        5 => 'H',
        6 => 'H+',
        7 => 'G',
        8 => 'G+',
        9 => 'F',
        10 => 'F+',
        11 => 'E',
        12 => 'E+',
        13 => 'D',
        14 => 'D+',
        15 => 'C',
        16 => 'C+',
        17 => 'B',
        18 => 'B+',
        19 => 'A',
        20 => 'A+',
        21 => 'CN',
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
