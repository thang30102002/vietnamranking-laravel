<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    public static function get_all()
    {
        $players = self::all();
        return $players;
    }
    public static function get_detail($id)
    {
        $player = self::find($id);
        return $player;
    }
}
