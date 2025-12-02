<?php

use function Livewire\Volt\{state, computed};
use App\Services\StudentService;

$studentService = app(StudentService::class);

state(['selectedYearId' => null]);

$academicYears = computed(fn() => \App\Models\AcademicYear::orderBy('year', 'desc')->get());
$currentYear = computed(fn() => $studentService->getCurrentAcademicYear());
$distribution = computed(function () {
    $yearId = $this->selectedYearId ?? $this->currentYear?->id;
    if (!$yearId)
        return collect();
    return $studentService->getAlumniDistribution($yearId);
});

$groupedDistribution = computed(function () {
    return $this->distribution->groupBy('school_type');
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
                <h1 class="text-4xl font-bold text-gray-900 mb-4">Sebaran Alumni</h1>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Distribusi alumni berdasarkan sekolah lanjutan
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

            @if($this->distribution->isNotEmpty())
                <!-- Summary Card -->
                <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 mb-8">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-gray-900 mb-1">
                                {{ number_format($this->distribution->sum('student_count')) }}</div>
                            <div class="text-gray-600">Total Alumni</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-primary-600 mb-1">
                                {{ number_format($this->groupedDistribution->get('SMA', collect())->sum('student_count')) }}
                            </div>
                            <div class="text-gray-600">SMA</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-secondary-600 mb-1">
                                {{ number_format($this->groupedDistribution->get('SMK', collect())->sum('student_count')) }}
                            </div>
                            <div class="text-gray-600">SMK</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-600 mb-1">
                                {{ number_format($this->groupedDistribution->get('MA', collect())->sum('student_count')) }}
                            </div>
                            <div class="text-gray-600">MA</div>
                        </div>
                    </div>
                </div>

                <!-- Distribution by School Type -->
                @foreach(['SMA', 'SMK', 'MA'] as $type)
                    @if($this->groupedDistribution->has($type))
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mb-6">
                            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                                <h3 class="text-lg font-semibold text-gray-900">{{ $type }}</h3>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full">
                                    <thead class="bg-gray-50 border-b border-gray-200">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-900">Nama Sekolah</th>
                                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-900">Jumlah Siswa</th>
                                            <th class="px-6 py-3 text-center text-sm font-semibold text-gray-900">Persentase</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-200">
                                        @php
                                            $typeTotal = $this->groupedDistribution->get($type)->sum('student_count');
                                        @endphp
                                        @foreach($this->groupedDistribution->get($type)->sortByDesc('student_count') as $school)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-4 text-gray-900">{{ $school->school_name }}</td>
                                                <td class="px-6 py-4 text-center">
                                                    <span
                                                        class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium">
                                                        {{ number_format($school->student_count) }}
                                                    </span>
                                                </td>
                                                <td class="px-6 py-4 text-center text-gray-600">
                                                    {{ number_format(($school->student_count / $typeTotal) * 100, 1) }}%
                                                </td>
                                            </tr>
                                        @endforeach
                                        <tr class="bg-gray-50 font-semibold">
                                            <td class="px-6 py-4 text-gray-900">Total {{ $type }}</td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="px-3 py-1 bg-primary-600 text-white rounded-full text-sm font-semibold">
                                                    {{ number_format($typeTotal) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center text-gray-900">
                                                {{ number_format(($typeTotal / $this->distribution->sum('student_count')) * 100, 1) }}%
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                @endforeach
            @else
                <div class="text-center py-12">
                    <svg class="w-24 h-24 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                    </svg>
                    <p class="text-gray-500">Belum ada data sebaran alumni</p>
                </div>
            @endif
        </div>
    </div>
</x-layouts.app>