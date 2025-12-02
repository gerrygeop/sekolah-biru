<?php

use function Livewire\Volt\{computed};
use App\Services\GalleryService;

$galleryService = app(GalleryService::class);
$photos = computed(fn() => $galleryService->getAllPhotos(24));

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Galeri Foto</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Dokumentasi kegiatan dan momen berharga di sekolah
                </p>
            </div>

            @if($this->photos->isNotEmpty())
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach($this->photos as $photo)
                        <div
                            class="group relative aspect-square bg-gray-200 rounded-lg overflow-hidden card-hover cursor-pointer">
                            <img src="{{ Storage::url($photo->image_path) }}" alt="{{ $photo->title }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <h3 class="text-white font-semibold text-sm">{{ $photo->title }}</h3>
                                    @if($photo->description)
                                        <p class="text-white/80 text-xs mt-1 line-clamp-2">{{ $photo->description }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $this->photos->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                    <p class="text-gray-500">Belum ada foto</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>