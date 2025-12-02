<?php

use function Livewire\Volt\{state, computed};
use App\Services\StudentService;

$studentService = app(StudentService::class);

state(['selectedYearId' => null]);

$academicYears = computed(fn() => \App\Models\AcademicYear::orderBy('year', 'desc')->get());
$currentYear = computed(fn() => $studentService->getCurrentAcademicYear());
$statistics = computed(function () {
    $yearId = $this->selectedYearId ?? $this->currentYear?->id;
    if (!$yearId)
        return collect();
    return $studentService->getStudentStatistics($yearId);
});

$totalStats = computed(function () {
    $stats = $this->statistics;
    return [
        'total' => $stats->sum(fn($s) => $s->male_count + $s->female_count),
        'male' => $stats->sum('male_count'),
        'female' => $stats->sum('female_count'),
    ];
});

$setYear = function ($yearId) {
    $this->selectedYearId = $yearId;
};

?>

<x-layouts.app>
    <div class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Page Header -->
            <div class="text-center mb-12">
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Data Siswa</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Statistik siswa per tingkat kelas
                </p>
            </div>

            <!-- Academic Year Selector -->
            @if($this->academicYears->isNotEmpty())
                <div class="flex flex-wrap gap-2 justify-center mb-8">
                    @foreach($this->academicYears as $year)
                        <button wire:click="setYear({{ $year->id }})"
                            class="px-6 py-2 rounded-lg font-medium transition {{ ($selectedYearId ?? $this->currentYear?->id) === $year->id ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-50' }}">
                            {{ $year->year }}
                            @if($year->is_active)
                                <span class="ml-1 text-xs">(Aktif)</span>
                            @endif
                        </button>
                    @endforeach
                </div>
            @endif

            @if($this->statistics->isNotEmpty())
                <!-- Summary Cards -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($this->totalStats['total']) }}
                        </div>
                        <div class="text-gray-600">Total Siswa</div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($this->totalStats['male']) }}
                        </div>
                        <div class="text-gray-600">Laki-laki</div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-pink-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-pink-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($this->totalStats['female']) }}
                        </div>
                        <div class="text-gray-600">Perempuan</div>
                    </div>
                </div>

                <!-- Statistics Table -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50 border-b border-gray-200">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-900">Kelas</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Laki-laki</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Perempuan</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Total</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-900">Rombel</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($this->statistics as $stat)
                                    <tr class="hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <span class="font-semibold text-gray-900">Kelas {{ $stat->grade }}</span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-blue-100 text-blue-700 rounded-full text-sm font-medium">
                                                {{ number_format($stat->male_count) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="px-3 py-1 bg-pink-100 text-pink-700 rounded-full text-sm font-medium">
                                                {{ number_format($stat->female_count) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span
                                                class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-semibold">
                                                {{ number_format($stat->male_count + $stat->female_count) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-center text-gray-600">
                                            {{ $stat->class_count }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Visual Chart -->
                <div class="mt-8 bg-white rounded-xl p-6 shadow-sm border border-gray-100">
                    <h3 class="text-lg font-semibold text-gray-900 mb-6">Distribusi Siswa per Kelas</h3>
                    <div class="space-y-4">
                        @foreach($this->statistics as $stat)
                            @php
                                $total = $stat->male_count + $stat->female_count;
                                $malePercentage = $total > 0 ? ($stat->male_count / $total) * 100 : 0;
                                $femalePercentage = $total > 0 ? ($stat->female_count / $total) * 100 : 0;
                            @endphp
                            <div>
                                <div class="flex items-center justify-between mb-2">
                                    <span class="font-medium text-gray-900">Kelas {{ $stat->grade }}</span>
                                    <span class="text-sm text-gray-600">{{ number_format($total) }} siswa</span>
                                </div>
                                <div class="flex h-8 rounded-lg overflow-hidden">
                                    <div class="bg-blue-500 flex items-center justify-center text-white text-xs font-medium"
                                        style="width: {{ $malePercentage }}%">
                                        @if($malePercentage > 15)
                                            {{ number_format($stat->male_count) }} L
                                        @endif
                                    </div>
                                    <div class="bg-pink-500 flex items-center justify-center text-white text-xs font-medium"
                                        style="width: {{ $femalePercentage }}%">
                                        @if($femalePercentage > 15)
                                            {{ number_format($stat->female_count) }} P
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-gray-500">Belum ada data statistik siswa</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>