<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Services\NewsService;
use App\Services\StudentService;
use App\Services\SchoolProfileService;
use Artesaos\SEOTools\Facades\SEOTools;

class Index extends Component
{
    public function mount()
    {
        // Set SEO for homepage
        SEOTools::setTitle('Beranda - SMP Digital', false);
        SEOTools::setDescription('Website resmi SMP Digital - Sekolah Menengah Pertama unggul dalam prestasi dan berkarakter');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
    }

    public function render()
    {
        $newsService = app(NewsService::class);
        $studentService = app(StudentService::class);
        $schoolService = app(SchoolProfileService::class);

        $latestNews = $newsService->getLatestNews(4);
        $featuredAchievements = $studentService->getAchievements(null, 3);
        $currentYear = $studentService->getCurrentAcademicYear();
        $schoolProfile = $schoolService->getSchoolProfile();

        $stats = null;
        if ($currentYear) {
            $statistics = $studentService->getStudentStatistics($currentYear->id);
            $totalStudents = $statistics->sum(function ($stat) {
                return $stat->male_count + $stat->female_count;
            });

            $employees = $schoolService->getEmployees('guru');
            $achievements = $studentService->getAchievements(null, null);

            $stats = [
                'students' => $totalStudents,
                'teachers' => $employees->count(),
                'achievements' => $achievements->count(),
            ];
        }

        return view('livewire.home.index', [
            'latestNews' => $latestNews,
            'featuredAchievements' => $featuredAchievements,
            'schoolProfile' => $schoolProfile,
            'stats' => $stats,
        ]);
    }
}
