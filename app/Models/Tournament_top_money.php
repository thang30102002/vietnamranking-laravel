<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament_top_money extends Model
{
    public function achievements()
    {
        return $this->hasMany(Achievement::class);
    }

    public function tournament()
    {
        return $this->belongsTo(Tournament::class);
    }
}
