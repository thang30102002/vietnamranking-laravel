<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Game_type extends Model
{
    public function tournament_game_type()
    {
        return $this->hasOne(Tournament_game_type::class);
    }
}
