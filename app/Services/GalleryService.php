<?php

namespace App\Services;

use App\Models\PhotoGallery;
use App\Models\VideoGallery;
use Illuminate\Support\Facades\Cache;

class GalleryService
{
    public function getLatestPhotos($limit = 6)
    {
        return Cache::remember('latest_photos', 3600, function () use ($limit) {
            return PhotoGallery::published()
                ->orderBy('order')
                ->latest('photo_date')
                ->limit($limit)
                ->get();
        });
    }

    public function getAllPhotos($perPage = 12)
    {
        return PhotoGallery::published()
            ->orderBy('order')
            ->latest('photo_date')
            ->paginate($perPage);
    }

    public function getAllVideos($perPage = 12)
    {
        return VideoGallery::published()
            ->orderBy('order')
            ->latest('video_date')
            ->paginate($perPage);
    }

    public function clearGalleryCache()
    {
        Cache::forget('latest_photos');
    }
}
