<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'content',
        'user_id',
        'news_id',
        'parent_id',
    ];

    public function news()
    {
        return $this->belongsTo(News::class);
    }
}
