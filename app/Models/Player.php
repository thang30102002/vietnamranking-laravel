<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory, Notifiable;

class Player extends Model
{

    protected $fillable = [
        'name',
        'phone',
        'created_at',
        'updated_at',
        'img',
        'user_id',
    ];

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function achievement()
    {
        return $this->hasMany(Achievement::class);
    }
    public function get_achievement($id)
    {
        $player = self::find($id);
        $achievement = $player->achievement;
        return $achievement;
    }
}
