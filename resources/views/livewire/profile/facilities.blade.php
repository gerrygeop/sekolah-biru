<?php

use function Livewire\Volt\{computed};
use App\Services\SchoolProfileService;

$schoolService = app(SchoolProfileService::class);
$facilities = computed(fn() => $schoolService->getFacilities());

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Fasilitas Sekolah</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Sarana dan prasarana penunjang pembelajaran
                </p>
            </div>

            @if($this->facilities->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($this->facilities as $facility)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                            @if($facility->images->isNotEmpty())
                                <div class="aspect-video bg-gray-200 overflow-hidden">
                                    <img src="{{ Storage::url($facility->images->first()->image_path) }}"
                                        alt="{{ $facility->name }}" class="w-full h-full object-cover">
                                </div>
                            @else
                                <div
                                    class="aspect-video bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-5">
                                <div class="flex items-start justify-between mb-3">
                                    <h3 class="font-bold text-gray-900 flex-1">{{ $facility->name }}</h3>
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded {{ $facility->condition === 'baik' ? 'bg-green-100 text-green-700' : ($facility->condition === 'rusak_ringan' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700') }}">
                                        {{ ucwords(str_replace('_', ' ', $facility->condition)) }}
                                    </span>
                                </div>

                                @if($facility->description)
                                    <p class="text-sm text-gray-600 mb-3 line-clamp-2">{{ $facility->description }}</p>
                                @endif

                                <div class="flex items-center text-sm text-gray-500">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14" />
                                    </svg>
                                    <span>Jumlah: {{ $facility->quantity }} unit</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                    <p class="text-gray-500">Belum ada data fasilitas</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>