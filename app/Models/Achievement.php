<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Achievement extends Model
{
    use HasFactory, SoftDeletes, HasSlug;
    
    protected $fillable = [
        'title', 'slug', 'description', 'category', 'level', 'achievement_rank',
        'student_name', 'student_class', 'achievement_date', 'image_path',
        'created_by', 'is_published'
    ];
    
    protected $casts = [
        'achievement_date' => 'date',
        'is_published' => 'boolean'
    ];
    
    public function author()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }
}
