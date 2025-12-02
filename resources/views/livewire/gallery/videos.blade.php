<?php

use function Livewire\Volt\{computed};
use App\Services\GalleryService;

$galleryService = app(GalleryService::class);
$videos = computed(fn() => $galleryService->getAllVideos(12));

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Galeri Video</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Video kegiatan dan dokumentasi sekolah
                </p>
            </div>

            @if($this->videos->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($this->videos as $video)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                            <div class="aspect-video bg-gray-900">
                                <iframe src="https://www.youtube.com/embed/{{ $video->youtube_id }}" title="{{ $video->title }}"
                                    frameborder="0"
                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen class="w-full h-full"></iframe>
                            </div>
                            <div class="p-5">
                                <h3 class="font-semibold text-gray-900 mb-2">{{ $video->title }}</h3>
                                @if($video->description)
                                    <p class="text-sm text-gray-600 line-clamp-2">{{ $video->description }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $this->videos->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500">Belum ada video</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>