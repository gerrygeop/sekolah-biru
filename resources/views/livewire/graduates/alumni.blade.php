<?php

use function Livewire\Volt\{computed};
use App\Services\StudentService;

$studentService = app(StudentService::class);
$featuredAlumni = computed(fn() => $studentService->getFeaturedAlumni(6));
$allAlumni = computed(fn() => $studentService->getAllAlumni(12));

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Data Alumni</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jejak kesuksesan lulusan kami
                </p>
            </div>

            <!-- Featured Alumni -->
            @if($this->featuredAlumni->isNotEmpty())
                <div class="mb-12">
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Alumni Unggulan</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($this->featuredAlumni as $alumni)
                            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                                @if($alumni->photo_path)
                                    <div class="aspect-square bg-gray-200 overflow-hidden">
                                        <img src="{{ Storage::url($alumni->photo_path) }}" alt="{{ $alumni->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="aspect-square bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                                        <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="p-5">
                                    <h3 class="font-bold text-gray-900 mb-1">{{ $alumni->name }}</h3>
                                    <p class="text-sm text-primary-600 mb-2">Angkatan {{ $alumni->graduation_year }}</p>
                                    @if($alumni->current_school)
                                        <p class="text-sm text-gray-600 mb-2">{{ $alumni->current_school }}</p>
                                    @endif
                                    @if($alumni->achievement)
                                        <p class="text-xs text-gray-500 italic">{{ $alumni->achievement }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- All Alumni -->
            @if($this->allAlumni->isNotEmpty())
                <div>
                    <h2 class="text-2xl font-bold text-gray-900 mb-6">Semua Alumni</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach($this->allAlumni as $alumni)
                            <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                                @if($alumni->photo_path)
                                    <div class="aspect-portrait bg-gray-200 overflow-hidden">
                                        <img src="{{ Storage::url($alumni->photo_path) }}" alt="{{ $alumni->name }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @else
                                    <div
                                        class="aspect-portrait bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                                        <svg class="w-16 h-16 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                        </svg>
                                    </div>
                                @endif

                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-900 mb-1">{{ $alumni->name }}</h3>
                                    <p class="text-xs text-gray-500">Angkatan {{ $alumni->graduation_year }}</p>
                                    @if($alumni->current_school)
                                        <p class="text-xs text-gray-600 mt-1">{{ $alumni->current_school }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        {{ $this->allAlumni->links() }}
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <p class="text-gray-500">Belum ada data alumni</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>