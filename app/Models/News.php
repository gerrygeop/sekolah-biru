<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class News extends Model
{
    use HasFactory, SoftDeletes, HasSlug;
    
    protected $fillable = [
        'category_id', 'title', 'slug', 'excerpt', 'content', 'featured_image',
        'publish_date', 'status', 'author_id', 'views', 'is_featured', 'is_pinned',
        'meta_title', 'meta_description', 'meta_keywords'
    ];
    
    protected $casts = [
        'publish_date' => 'date',
        'is_featured' => 'boolean',
        'is_pinned' => 'boolean'
    ];
    
    public function category()
    {
        return $this->belongsTo(NewsCategory::class, 'category_id');
    }
    
    public function author()
    {
        return $this->belongsTo(User::class, 'author_id');
    }
    
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
                    ->where('publish_date', '<=', now());
    }
    
    public function incrementViews()
    {
        $this->increment('views');
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }
}
