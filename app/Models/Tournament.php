<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    public function ranking_tournament()
    {
        return $this->hasMany(Ranking_tournament::class);
    }

    public function admin_tournament()
    {
        return $this->hasOne(Admin_tournament::class);
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
}
