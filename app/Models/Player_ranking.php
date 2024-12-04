<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player_ranking extends Model
{
    protected $fillable = [
        'player_id',
        'ranking_id',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function ranking()
    {
        return $this->belongsTo(Ranking::class);
    }
}
