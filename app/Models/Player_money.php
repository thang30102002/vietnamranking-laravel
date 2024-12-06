<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player_money extends Model
{
    protected $fillable = [
        'player_id',
        'money',
    ];

    public function player()
    {
        return $this->belongsTo(Player::class);
    }
}
