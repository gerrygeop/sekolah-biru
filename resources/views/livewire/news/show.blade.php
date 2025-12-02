<?php

use function Livewire\Volt\{state, mount};
use App\Services\NewsService;
use App\Services\SeoService;
use App\Models\News;

state(['news']);

mount(function (News $news) {
    $this->news = $news;

    // Set SEO
    $seoService = app(SeoService::class);
    $seoService->setNewsSeo($news);

    // Increment views
    $news->increment('views');
});

$relatedNews = fn() => app(NewsService::class)->getLatestNews(3);

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Breadcrumb -->
                <nav class="mb-6">
                    <ol class="flex items-center space-x-2 text-sm text-gray-600">
                        <li><a href="{{ route('home') }}" class="hover:text-primary-600">Beranda</a></li>
                        <li>/</li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-primary-600">Berita</a></li>
                        <li>/</li>
                        <li class="text-gray-900">{{ $news->title }}</li>
                    </ol>
                </nav>

                <!-- Article -->
                <article class="bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                    @if($news->featured_image_path)
                        <div class="aspect-video bg-gray-200">
                            <img src="{{ Storage::url($news->featured_image_path) }}" alt="{{ $news->title }}"
                                class="w-full h-full object-cover">
                        </div>
                    @endif

                    <div class="p-8 md:p-12">
                        <!-- Meta -->
                        <div class="flex flex-wrap items-center gap-4 mb-6">
                            <span class="px-3 py-1 bg-primary-100 text-primary-700 text-sm font-medium rounded">
                                {{ $news->category->name }}
                            </span>
                            <span class="text-sm text-gray-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $news->published_at->format('d F Y') }}
                            </span>
                            <span class="text-sm text-gray-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                {{ number_format($news->views) }} views
                            </span>
                        </div>

                        <!-- Title -->
                        <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-6">{{ $news->title }}</h1>

                        <!-- Content -->
                        <div class="prose prose-lg max-w-none">
                            {!! $news->content !!}
                        </div>
                    </div>
                </article>

                <!-- Related News -->
                @if($this->relatedNews->isNotEmpty())
                    <div class="mt-12">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Berita Terkait</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach($this->relatedNews as $related)
                                <a href="{{ route('news.show', $related->slug) }}"
                                    class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                                    @if($related->featured_image_path)
                                        <div class="aspect-video bg-gray-200 overflow-hidden">
                                            <img src="{{ Storage::url($related->featured_image_path) }}" alt="{{ $related->title }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        </div>
                                    @endif
                                    <div class="p-4">
                                        <h3
                                            class="font-semibold text-gray-900 line-clamp-2 group-hover:text-primary-600 transition">
                                            {{ $related->title }}
                                        </h3>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-layouts.app>