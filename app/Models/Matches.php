<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Matches extends Model
{
    protected $fillable = [
        'tournament_id',
        'round',
        'player_id_win',
        'score',
        'player_id_1',
        'player_id_2',
        'location'
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
