<?php

namespace App\Services;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Storage;

class SeoService
{
    public function setPageSeo(string $title, string $description, ?string $image = null)
    {
        SEOTools::setTitle($title);
        SEOTools::setDescription($description);
        SEOTools::opengraph()->setUrl(request()->url());
        SEOTools::opengraph()->addProperty('type', 'website');
        SEOTools::twitter()->setSite('@sekolah');
        
        if ($image) {
            $imageUrl = filter_var($image, FILTER_VALIDATE_URL) ? $image : Storage::url($image);
            SEOTools::opengraph()->addImage($imageUrl);
            SEOTools::twitter()->setImage($imageUrl);
        }
        
        SEOTools::jsonLd()->setType('WebPage');
    }
    
    public function setNewsSeo($news)
    {
        SEOTools::setTitle($news->meta_title ?? $news->title);
        SEOTools::setDescription($news->meta_description ?? $news->excerpt);
        SEOTools::opengraph()->setUrl(route('news.show', $news->slug));
        SEOTools::opengraph()->addProperty('type', 'article');
        SEOTools::opengraph()->addProperty('article:published_time', $news->publish_date->toIso8601String());
        
        if ($news->featured_image) {
            SEOTools::opengraph()->addImage(Storage::url($news->featured_image));
        }
        
        SEOTools::jsonLd()->setType('Article');
        SEOTools::jsonLd()->addValue('headline', $news->title);
        SEOTools::jsonLd()->addValue('datePublished', $news->publish_date->toIso8601String());
        if ($news->author) {
             SEOTools::jsonLd()->addValue('author', [
                '@type' => 'Person',
                'name' => $news->author->name
            ]);
        }
    }
}
