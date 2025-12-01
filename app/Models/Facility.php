<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Facility extends Model
{
    use HasFactory, HasSlug;
    
    protected $fillable = [
        'name', 'slug', 'description', 'quantity', 'condition', 'order', 'is_published'
    ];
    
    protected $casts = ['is_published' => 'boolean'];
    
    public function images()
    {
        return $this->hasMany(FacilityImage::class)->orderBy('order');
    }
    
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('name')->saveSlugsTo('slug');
    }
}
