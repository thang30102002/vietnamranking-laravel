<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament_top_money extends Model
{
    protected $fillable = [
        'tournament_id',
        'top',
        'money'
    ];

    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
