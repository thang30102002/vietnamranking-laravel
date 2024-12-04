<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory, Notifiable;

class Admin_tournament extends Model
{
    protected $fillable = [
        'name',
        'information',
        'img',
        'phone',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class); 
    }

    public static function get_all()
    {
        $tournament = self::all();
        return $tournament;
    }

    public function tournament()
    {
        return $this->hasMany(Tournament::class); 
    }
}
