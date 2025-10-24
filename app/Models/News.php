<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class News extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'content',
        'image',
        'youtube_url',
        'excerpt',
        'status',
        'author_id',
        'category_id',
        'views'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)
            ->whereNull('parent_id')
            ->latest();
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Auto-generate slug from title
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($news) {
            if (empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
        
        static::updating(function ($news) {
            if ($news->isDirty('title') && empty($news->slug)) {
                $news->slug = Str::slug($news->title);
            }
        });
    }

    // Scope for published news
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    // Scope for draft news
    public function scopeDraft($query)
    {
        return $query->where('status', 'draft');
    }

    // Get excerpt or generate from content
    public function getExcerptAttribute($value)
    {
        if ($value) {
            return $value;
        }
        
        return Str::limit(strip_tags($this->content), 150);
    }

    // Get formatted date
    public function getFormattedDateAttribute()
    {
        return $this->created_at->format('d/m/Y');
    }

    // Increment views
    public function incrementViews()
    {
        $this->increment('views');
    }
}
