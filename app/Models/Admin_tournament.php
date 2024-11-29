<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use HasFactory, Notifiable;

class Admin_tournament extends Model
{
<<<<<<< Updated upstream
    protected $fillable = [
        'name',
        'information',
        'img',
        'phone',
        'user_id',
    ];
=======
>>>>>>> Stashed changes
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
