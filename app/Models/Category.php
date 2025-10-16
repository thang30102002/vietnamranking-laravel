<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'is_active',
        'sort_order',
        'parent_id'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Auto-generate slug from name
    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
        
        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    // Relationship with News
    public function news()
    {
        return $this->hasMany(News::class, 'category_id');
    }

    // Parent-child relationships
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function allChildren()
    {
        return $this->children()->with('allChildren');
    }

    public function descendants()
    {
        return $this->children()->with('descendants');
    }

    public function ancestors()
    {
        return $this->parent()->with('ancestors');
    }

    // Scope for active categories
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    // Scope for ordering
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Scope for root categories (no parent)
    public function scopeRoot($query)
    {
        return $query->whereNull('parent_id');
    }

    // Scope for child categories
    public function scopeChildren($query, $parentId)
    {
        return $query->where('parent_id', $parentId);
    }

    // Get full path (breadcrumb)
    public function getFullPathAttribute()
    {
        $path = collect([$this]);
        $parent = $this->parent;
        
        while ($parent) {
            $path->prepend($parent);
            $parent = $parent->parent;
        }
        
        return $path;
    }

    // Get breadcrumb string
    public function getBreadcrumbAttribute()
    {
        return $this->full_path->pluck('name')->join(' > ');
    }

    // Get level (depth)
    public function getLevelAttribute()
    {
        return $this->full_path->count() - 1;
    }

    // Check if category has children
    public function hasChildren()
    {
        return $this->children()->exists();
    }

    // Get all descendants (recursive)
    public function getAllDescendants()
    {
        $descendants = collect();
        
        foreach ($this->children as $child) {
            $descendants->push($child);
            $descendants = $descendants->merge($child->getAllDescendants());
        }
        
        return $descendants;
    }

    // Get all ancestors (recursive)
    public function getAllAncestors()
    {
        $ancestors = collect();
        $parent = $this->parent;
        
        while ($parent) {
            $ancestors->prepend($parent);
            $parent = $parent->parent;
        }
        
        return $ancestors;
    }

    // Get formatted color for CSS
    public function getFormattedColorAttribute()
    {
        return $this->color ?: '#21324C';
    }

    // Get icon HTML
    public function getIconHtmlAttribute()
    {
        if ($this->icon) {
            return '<i class="' . $this->icon . '"></i>';
        }
        return '<i class="fas fa-folder"></i>';
    }

    // Get news count
    public function getNewsCountAttribute()
    {
        return $this->news()->published()->count();
    }

    // Check if category has news
    public function hasNews()
    {
        return $this->news()->published()->exists();
    }
}