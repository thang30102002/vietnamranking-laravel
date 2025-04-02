<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'slug',
        'user_id',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function post_images()
    {
        return $this->hasMany(Post_image::class);
    }

    public function post_comments()
    {
        return $this->hasMany(Post_comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
}
