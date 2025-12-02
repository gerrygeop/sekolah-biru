<?php

use function Livewire\Volt\{state, computed};
use App\Services\NewsService;
use App\Services\StudentService;
use App\Services\SchoolProfileService;

$newsService = app(NewsService::class);
$studentService = app(StudentService::class);
$schoolService = app(SchoolProfileService::class);

state(['newsService' => $newsService]);
state(['studentService' => $studentService]);
state(['schoolService' => $schoolService]);

$latestNews = computed(fn() => $this->newsService->getLatestNews(4));
$featuredAchievements = computed(fn() => $this->studentService->getAchievements(null, 3));
$currentYear = computed(fn() => $this->studentService->getCurrentAcademicYear());
$schoolProfile = computed(fn() => $this->schoolService->getSchoolProfile());
$stats = computed(function () {
    $year = $this->currentYear;
    if (!$year)
        return null;

    $statistics = $this->studentService->getStudentStatistics($year->id);
    $totalStudents = $statistics->sum(function ($stat) {
        return $stat->male_count + $stat->female_count;
    });

    $employees = $this->schoolService->getEmployees('guru');
    $achievements = $this->studentService->getAchievements(null, null);

    return [
        'students' => $totalStudents,
        'teachers' => $employees->count(),
        'achievements' => $achievements->count(),
    ];
});

?>

<x-layouts.app>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 text-white overflow-hidden">
        <div class="absolute inset-0 bg-black/10"></div>
        <div
            class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iNjAiIGhlaWdodD0iNjAiIHZpZXdCb3g9IjAgMCA2MCA2MCIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48ZyBmaWxsPSJub25lIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiPjxnIGZpbGw9IiNmZmYiIGZpbGwtb3BhY2l0eT0iMC4wNSI+PHBhdGggZD0iTTM2IDE0YzMuMzEgMCA2IDIuNjkgNiA2cy0yLjY5IDYtNiA2LTYtMi42OS02LTYgMi42OS02IDYtNnpNNiAzNGMzLjMxIDAgNiAyLjY5IDYgNnMtMi42OSA2LTYgNi02LTIuNjktNi02IDIuNjktNiA2LTZ6TTM2IDM0YzMuMzEgMCA2IDIuNjkgNiA2cy0yLjY5IDYtNiA2LTYtMi42OS02LTYgMi42OS02IDYtNnoiLz48L2c+PC9nPjwvc3ZnPg==')] opacity-20">
        </div>

        <div class="container mx-auto px-4 py-20 md:py-32 relative z-10">
            <div class="max-w-3xl animate-fade-in-up">
                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6">
                    {{ $this->schoolProfile?->school_name ?? 'SMP Digital' }}
                </h1>
                <p class="text-xl md:text-2xl text-primary-100 mb-8">
                    {{ $this->schoolProfile?->vision ?? 'Unggul dalam Prestasi, Berkarakter dalam Kehidupan' }}
                </p>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('profile.vision-mission') }}"
                        class="px-6 py-3 bg-white text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition">
                        Tentang Kami
                    </a>
                    <a href="{{ route('contact') }}"
                        class="px-6 py-3 bg-primary-500 text-white rounded-lg font-semibold hover:bg-primary-400 transition border-2 border-white/20">
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>

        <!-- Wave Divider -->
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full h-auto">
                <path
                    d="M0 120L60 105C120 90 240 60 360 45C480 30 600 30 720 37.5C840 45 960 60 1080 67.5C1200 75 1320 75 1380 75L1440 75V120H1380C1320 120 1200 120 1080 120C960 120 840 120 720 120C600 120 480 120 360 120C240 120 120 120 60 120H0Z"
                    fill="#f9fafb" />
            </svg>
        </div>
    </section>

    <!-- Stats Section -->
    @if($this->stats)
        <section class="py-12 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-primary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-primary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ number_format($this->stats['students']) }}
                        </div>
                        <div class="text-gray-600">Siswa Aktif</div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-secondary-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-secondary-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $this->stats['teachers'] }}</div>
                        <div class="text-gray-600">Tenaga Pendidik</div>
                    </div>

                    <div class="bg-white rounded-xl p-6 shadow-sm border border-gray-100 text-center">
                        <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mx-auto mb-4">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                        <div class="text-3xl font-bold text-gray-900 mb-1">{{ $this->stats['achievements'] }}</div>
                        <div class="text-gray-600">Prestasi</div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Latest News Section -->
    @if($this->latestNews->isNotEmpty())
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Berita Terkini</h2>
                        <p class="text-gray-600">Informasi dan update terbaru dari sekolah</p>
                    </div>
                    <a href="{{ route('news.index') }}"
                        class="text-primary-600 hover:text-primary-700 font-semibold flex items-center">
                        Lihat Semua
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($this->latestNews as $news)
                        <a href="{{ route('news.show', $news->slug) }}"
                            class="group bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                            @if($news->featured_image_path)
                                <div class="aspect-video bg-gray-200 overflow-hidden">
                                    <img src="{{ Storage::url($news->featured_image_path) }}" alt="{{ $news->title }}"
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
                                        {{ $news->category->name }}
                                    </span>
                                    <span class="text-xs text-gray-500">
                                        {{ $news->published_at->diffForHumans() }}
                                    </span>
                                </div>
                                <h3
                                    class="font-semibold text-gray-900 mb-2 line-clamp-2 group-hover:text-primary-600 transition">
                                    {{ $news->title }}
                                </h3>
                                <p class="text-sm text-gray-600 line-clamp-2">
                                    {{ $news->excerpt }}
                                </p>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- Featured Achievements Section -->
    @if($this->featuredAchievements->isNotEmpty())
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <h2 class="text-3xl font-bold text-gray-900 mb-2">Prestasi Unggulan</h2>
                        <p class="text-gray-600">Kebanggaan siswa-siswi kami</p>
                    </div>
                    <a href="{{ route('graduates.achievements') }}"
                        class="text-primary-600 hover:text-primary-700 font-semibold flex items-center">
                        Lihat Semua
                        <svg class="w-5 h-5 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </a>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($this->featuredAchievements as $achievement)
                        <div class="bg-white rounded-xl overflow-hidden shadow-sm border border-gray-100 card-hover">
                            @if($achievement->image_path)
                                <div class="aspect-video bg-gray-200 overflow-hidden">
                                    <img src="{{ Storage::url($achievement->image_path) }}" alt="{{ $achievement->title }}"
                                        class="w-full h-full object-cover">
                                </div>
                            @else
                                <div
                                    class="aspect-video bg-gradient-to-br from-secondary-400 to-secondary-600 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                </div>
                            @endif

                            <div class="p-5">
                                <div class="flex items-center gap-2 mb-3">
                                    <span class="px-2 py-1 bg-secondary-100 text-secondary-700 text-xs font-medium rounded">
                                        {{ $achievement->category }}
                                    </span>
                                    <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">
                                        {{ $achievement->rank }}
                                    </span>
                                </div>
                                <h3 class="font-semibold text-gray-900 mb-2">
                                    {{ $achievement->title }}
                                </h3>
                                <p class="text-sm text-gray-600 mb-2">
                                    {{ $achievement->student_name }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    {{ $achievement->achievement_date->format('d M Y') }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div
                class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-8 md:p-12 text-white text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-4">Bergabunglah Bersama Kami</h2>
                <p class="text-xl text-primary-100 mb-8 max-w-2xl mx-auto">
                    Wujudkan impian pendidikan terbaik untuk putra-putri Anda di lingkungan yang kondusif dan
                    berkualitas
                </p>
                <div class="flex flex-wrap gap-4 justify-center">
                    <a href="{{ route('contact') }}"
                        class="px-8 py-3 bg-white text-primary-600 rounded-lg font-semibold hover:bg-primary-50 transition">
                        Hubungi Kami
                    </a>
                    <a href="{{ route('profile.facilities') }}"
                        class="px-8 py-3 bg-primary-500 text-white rounded-lg font-semibold hover:bg-primary-400 transition border-2 border-white/20">
                        Lihat Fasilitas
                    </a>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>