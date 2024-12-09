<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player_registed_tournament extends Model
{
    protected $fillable = [
        'tournament_id',
        'player_id',
        'status',
    ];

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
