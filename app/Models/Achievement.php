<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    protected $fillable = [
        'player_id',
        'tournament_top_money_id',
    ];
    public function player()
    {
        return $this->belongsTo(Player::class, 'player_id');
    }

    public function tournament_top_money()
    {
        return $this->belongsTo(Tournament_top_money::class, 'tournament_top_money_id');
    }
}
