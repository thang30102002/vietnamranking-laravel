<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament_game_type extends Model
{
    protected $fillable = [
        'tournament_id',
        'game_type_id',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function game_type()
    {
        return $this->belongsTo(Game_type::class);
    }
}
