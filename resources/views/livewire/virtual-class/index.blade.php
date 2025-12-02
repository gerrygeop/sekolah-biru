<?php

use function Livewire\Volt\{state, computed};
use App\Services\StudentService;

$studentService = app(StudentService::class);

state(['selectedGrade' => null]);

$virtualClasses = computed(function () {
    $query = \App\Models\VirtualClass::published();
    if ($this->selectedGrade) {
        $query->where('grade', $this->selectedGrade);
    }
    return $query->orderBy('order')->get();
});

$setGrade = function ($grade) {
    $this->selectedGrade = $grade;
};

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Kelas Virtual</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Materi pembelajaran dan sumber belajar online
                </p>
            </div>

            <!-- Grade Filter -->
            <div class="flex flex-wrap gap-2 justify-center mb-8">
                <button wire:click="setGrade(null)"
                    class="px-6 py-2 rounded-lg font-medium transition {{ $selectedGrade === null ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Semua
                </button>
                <button wire:click="setGrade(7)"
                    class="px-6 py-2 rounded-lg font-medium transition {{ $selectedGrade === 7 ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Kelas 7
                </button>
                <button wire:click="setGrade(8)"
                    class="px-6 py-2 rounded-lg font-medium transition {{ $selectedGrade === 8 ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Kelas 8
                </button>
                <button wire:click="setGrade(9)"
                    class="px-6 py-2 rounded-lg font-medium transition {{ $selectedGrade === 9 ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                    Kelas 9
                </button>
            </div>

            @if($this->virtualClasses->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($this->virtualClasses as $class)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                            <div class="p-6">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="px-3 py-1 bg-primary-100 text-primary-700 text-sm font-medium rounded">
                                        Kelas {{ $class->grade }}
                                    </span>
                                    <span class="px-3 py-1 bg-secondary-100 text-secondary-700 text-sm font-medium rounded">
                                        {{ ucfirst($class->type) }}
                                    </span>
                                </div>

                                <h3 class="font-bold text-gray-900 mb-2">{{ $class->title }}</h3>

                                @if($class->description)
                                    <p class="text-sm text-gray-600 mb-4 line-clamp-2">{{ $class->description }}</p>
                                @endif

                                @if($class->type === 'link')
                                    <a href="{{ $class->content }}" target="_blank"
                                        class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                        Buka Link
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                @elseif($class->type === 'file')
                                    <a href="{{ Storage::url($class->content) }}" download
                                        class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                        Download File
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                        </svg>
                                    </a>
                                @elseif($class->type === 'embed')
                                    <button class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium">
                                        Lihat Materi
                                        <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                        </svg>
                                    </button>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                    </svg>
                    <p class="text-gray-500">Belum ada materi kelas virtual</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>