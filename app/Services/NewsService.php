<?php

namespace App\Services;

use App\Models\News;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class NewsService
{
    public function getPublishedNews($perPage = 10, $categoryId = null)
    {
        try {
            $query = News::with(['category', 'author'])
                ->published()
                ->latest('publish_date');
            
            if ($categoryId) {
                $query->where('category_id', $categoryId);
            }
            
            return $query->paginate($perPage);
        } catch (\Exception $e) {
            Log::error('Error fetching published news', [
                'error' => $e->getMessage(),
                'category_id' => $categoryId
            ]);
            throw $e;
        }
    }
    
    public function getFeaturedNews($limit = 5)
    {
        return Cache::remember('featured_news', 3600, function () use ($limit) {
            return News::with(['category', 'author'])
                ->published()
                ->where('is_featured', true)
                ->latest('publish_date')
                ->limit($limit)
                ->get();
        });
    }

    public function getLatestNews($limit = 5)
    {
        return News::with(['category', 'author'])
            ->published()
            ->latest('publish_date')
            ->limit($limit)
            ->get();
    }
    
    public function createNews(array $data)
    {
        try {
            DB::beginTransaction();
            
            $news = News::create($data);
            
            Log::info('News created', ['news_id' => $news->id, 'title' => $news->title]);
            
            // Clear cache
            Cache::forget('featured_news');
            
            DB::commit();
            return $news;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error creating news', ['error' => $e->getMessage(), 'data' => $data]);
            throw $e;
        }
    }
    
    public function updateNews(News $news, array $data)
    {
        try {
            DB::beginTransaction();
            
            $news->update($data);
            
            Log::info('News updated', ['news_id' => $news->id]);
            
            Cache::forget('featured_news');
            
            DB::commit();
            return $news;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error updating news', ['error' => $e->getMessage(), 'news_id' => $news->id]);
            throw $e;
        }
    }

    public function deleteNews(News $news)
    {
        try {
            DB::beginTransaction();
            
            $news->delete();
            
            Log::info('News deleted', ['news_id' => $news->id]);
            
            Cache::forget('featured_news');
            
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting news', ['error' => $e->getMessage(), 'news_id' => $news->id]);
            throw $e;
        }
    }
}
