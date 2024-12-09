<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    protected $fillable = [
        'name',
        'number_players',
        'start_date',
        'address',
        'fees',
        'status',
        'admin_tournament_id',
    ];

    public function player_registed_tournament()
    {
        return $this->hasMany(Player_registed_tournament::class);
    }
    
    public function tournament_game_type()
    {
        return $this->hasOne(Tournament_game_type::class);
    }

    public function ranking_tournament()
    {
        return $this->hasMany(Ranking_tournament::class);
    }

    public function admin_tournament()
    {
        return $this->belongsTo(Admin_tournament::class);
    }

    public function tournament_top_money()
    {
        return $this->hasMany(Tournament_top_money::class);
    }

    public static function get_all()
    {
        $tournament = self::all();
        return $tournament;
    }

    public static function get_all_apply()
    {
        $tournament = self::where('status', '=', '1')->get();
        return $tournament;
    }

}
