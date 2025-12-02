<?php

use function Livewire\Volt\{state, computed, with};
use App\Services\NewsService;

$newsService = app(NewsService::class);

state(['selectedCategory' => null]);

$news = computed(fn() => $newsService->getPublishedNews(12, $this->selectedCategory));
$categories = computed(fn() => \App\Models\NewsCategory::all());

$setCategory = function ($categoryId) {
    $this->selectedCategory = $categoryId;
};

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Berita & Informasi</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Update terkini seputar kegiatan dan informasi sekolah
                </p>
            </div>

            <!-- Category Filter -->
            @if($this->categories->isNotEmpty())
                <div class="flex flex-wrap gap-2 justify-center mb-8">
                    <button wire:click="setCategory(null)"
                        class="px-6 py-2 rounded-lg font-medium transition {{ $selectedCategory === null ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                        Semua
                    </button>
                    @foreach($this->categories as $category)
                        <button wire:click="setCategory({{ $category->id }})"
                            class="px-6 py-2 rounded-lg font-medium transition {{ $selectedCategory === $category->id ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                            {{ $category->name }}
                        </button>
                    @endforeach
                </div>
            @endif

            @if($this->news->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($this->news as $item)
                        <a href="{{ route('news.show', $item->slug) }}"
                            class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                            @if($item->featured_image_path)
                                <div class="aspect-video bg-gray-200 overflow-hidden">
                                    <img src="{{ Storage::url($item->featured_image_path) }}" alt="{{ $item->title }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </div>
                            @else
                                <div
                                    class="aspect-video bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-5">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-2 py-1 bg-primary-100 text-primary-700 text-xs font-medium rounded">
                                        {{ $item->category->name }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $item->published_at->format('d M Y') }}
                                    </span>
                                </div>
                                <h3
                                    class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition">
                                    {{ $item->title }}
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-3">
                                    {{ $item->excerpt }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $this->news->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                    </svg>
                    <p class="text-gray-500">Belum ada berita</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>