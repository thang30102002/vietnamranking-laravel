<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tournament_top_money extends Model
{
    public function achievements()
    {
        return $this->hasOne(Achievement::class);
    }
}
