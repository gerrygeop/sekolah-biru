<?php

namespace App\Livewire\News;

use App\Models\News;
use App\Services\NewsService;
use App\Services\SeoService;
use Livewire\Component;

class Show extends Component
{
    protected $news;

    public function mount(News $news)
    {
        $this->news = $news;

        // Set SEO
        $seoService = app(SeoService::class);
        $seoService->setNewsSeo($news);

        // Increment views
        $news->increment('views');
    }


    public function render()
    {
        $relatedNews = app(NewsService::class)->getRelatedNews($this->news, 3);

        return view('livewire.news.show', [
            'relatedNews' => $relatedNews,
            'news' => $this->news,
        ]);
    }
}
