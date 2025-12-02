<?php

use function Livewire\Volt\{computed};
use App\Services\SchoolProfileService;

$schoolService = app(SchoolProfileService::class);
$schoolProfile = computed(fn() => $schoolService->getSchoolProfile());

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Visi & Misi</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Komitmen kami dalam mewujudkan pendidikan berkualitas
                </p>
            </div>

            @if($this->schoolProfile)
                <!-- Vision Section -->
                <div class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100 mb-8">
                    <div class="flex items-center justify-center mb-6">
                        <div class="w-16 h-16 bg-primary-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-center text-gray-900 mb-6">Visi</h2>
                    <p class="text-xl text-center text-gray-700 leading-relaxed max-w-4xl mx-auto">
                        {{ $this->schoolProfile->vision }}
                    </p>
                </div>

                <!-- Mission Section -->
                <div class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100 mb-8">
                    <div class="flex items-center justify-center mb-6">
                        <div class="w-16 h-16 bg-secondary-100 rounded-full flex items-center justify-center">
                            <svg class="w-8 h-8 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-center text-gray-900 mb-8">Misi</h2>
                    <div class="prose prose-lg max-w-4xl mx-auto">
                        {!! nl2br(e($this->schoolProfile->mission)) !!}
                    </div>
                </div>

                <!-- About Section -->
                @if($this->schoolProfile->about)
                    <div class="bg-white rounded-2xl p-8 md:p-12 shadow-sm border border-gray-100">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6">Tentang Kami</h2>
                        <div class="prose prose-lg max-w-none">
                            {!! $this->schoolProfile->about !!}
                        </div>
                    </div>
                @endif
            @endif
        </div>
    </div>
</x-layouts.app>