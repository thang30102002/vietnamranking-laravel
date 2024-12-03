<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranking_tournament extends Model
{
    public function ranking()
    {
        return $this->belongsTo(Ranking::class);
    }
}
