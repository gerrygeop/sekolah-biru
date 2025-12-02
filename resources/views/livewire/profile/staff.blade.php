<?php

use function Livewire\Volt\{state, computed};
use App\Services\SchoolProfileService;

$schoolService = app(SchoolProfileService::class);

state(['selectedType' => 'all']);

$employees = computed(function () {
    $type = $this->selectedType === 'all' ? null : $this->selectedType;
    return $this->schoolService->getEmployees($type);
});

$setType = function ($type) {
    $this->selectedType = $type;
};

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Tenaga Pendidik</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Guru dan staff yang berdedikasi untuk pendidikan terbaik
                </p>
            </div>

            <!-- Filter Tabs -->
            <div class="flex flex-wrap gap-2 justify-center mb-8">
                <button wire:click="setType('all')"
                    class="px-6 py-2 rounded-lg font-medium transition {{ $selectedType === 'all' ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Semua
                </button>
                <button wire:click="setType('guru')"
                    class="px-6 py-2 rounded-lg font-medium transition {{ $selectedType === 'guru' ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Guru
                </button>
                <button wire:click="setType('staff')"
                    class="px-6 py-2 rounded-lg font-medium transition {{ $selectedType === 'staff' ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Staff
                </button>
                <button wire:click="setType('tenaga_kependidikan')"
                    class="px-6 py-2 rounded-lg font-medium transition {{ $selectedType === 'tenaga_kependidikan' ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Tenaga Kependidikan
                </button>
            </div>

            @if($this->employees->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($this->employees as $employee)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                            @if($employee->photo_path)
                                <div class="aspect-portrait bg-gray-200 overflow-hidden">
                                    <img src="{{ Storage::url($employee->photo_path) }}" alt="{{ $employee->name }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @else
                                <div
                                    class="aspect-portrait bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                                    <svg class="w-20 h-20 text-white/30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-5">
                                <h3 class="font-bold text-gray-900 mb-1">{{ $employee->name }}</h3>
                                @if($employee->position)
                                    <p class="text-sm text-primary-600 font-medium mb-2">{{ $employee->position }}</p>
                                @endif
                                @if($employee->subject)
                                    <p class="text-sm text-gray-600 mb-2">{{ $employee->subject }}</p>
                                @endif
                                @if($employee->education)
                                    <p class="text-xs text-gray-500">{{ $employee->education }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                    <p class="text-gray-500">Belum ada data tenaga pendidik</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>