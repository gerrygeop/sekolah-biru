<?php

namespace App\Livewire\News;

use Livewire\Component;
use App\Services\NewsService;
use App\Models\NewsCategory;
use Artesaos\SEOTools\Facades\SEOTools;

class Index extends Component
{
    public $selectedCategory = null;

    protected $newsService;

    public function mount()
    {
        $this->newsService = app(NewsService::class);

        SEOTools::setTitle('Berita - SMP Digital', false);
        SEOTools::setDescription('Website resmi SMP Digital - Sekolah Menengah Pertama unggul dalam prestasi dan berkarakter');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
    }

    public function setCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
    }

    public function getNews()
    {
        $newsService = $this->newsService ?? app(NewsService::class);
        return $newsService->getPublishedNews(12, $this->selectedCategory);
    }

    public function hydrate()
    {
        $this->newsService = $this->newsService ?? app(NewsService::class);
    }

    public function getCategories()
    {
        return NewsCategory::all();
    }

    public function render()
    {
        return view('livewire.news.index', [
            'news' => $this->getNews(),
            'categories' => $this->getCategories(),
        ]);
    }
}
