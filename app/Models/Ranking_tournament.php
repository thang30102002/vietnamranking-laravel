<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ranking_tournament extends Model
{
    protected $fillable = [
        'tournament_id',
        'ranking_id',
    ];

    public function ranking()
    {
        return $this->belongsTo(Ranking::class);
    }
}
