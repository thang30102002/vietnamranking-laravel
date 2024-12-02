<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory, Notifiable;

class Admin_tournament extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class); // Mỗi player thuộc về một user
    }

    public static function get_all()
    {
        $tournament = self::all();
        return $tournament;
    }
}
