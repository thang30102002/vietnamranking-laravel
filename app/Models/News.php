<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'view',
        'image',
        'topic_id'
    ];

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
