<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TournamentData extends Model
{
    protected $fillable = [
        'tournament_id',
        'tournament_data',
        'players',
        'tournament_type',
        'status',
        'last_updated'
    ];

    protected $casts = [
        'tournament_data' => 'array',
        'players' => 'array',
        'last_updated' => 'datetime'
    ];

    /**
     * Get the tournament that owns the data
     */
    public function tournament(): BelongsTo
    {
        return $this->belongsTo(Tournament::class);
    }

    /**
     * Update the last_updated timestamp
     */
    public function touchLastUpdated(): void
    {
        $this->update(['last_updated' => now()]);
    }
}
