<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player_ranking extends Model
{
    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function ranking()
    {
        return $this->belongsTo(Ranking::class);
    }
}
