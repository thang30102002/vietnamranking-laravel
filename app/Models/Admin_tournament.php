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
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class); // Mỗi player thuộc về một user
    }

}
