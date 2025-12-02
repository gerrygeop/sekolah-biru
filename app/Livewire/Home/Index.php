<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Services\NewsService;
use App\Services\StudentService;
use App\Services\SchoolProfileService;
use App\Services\SeoService;

class Index extends Component
{
    protected $newsService;
    protected $studentService;
    protected $schoolService;
    protected $seoService;

    public function boot(
        NewsService $newsService,
        StudentService $studentService,
        SchoolProfileService $schoolService,
        SeoService $seoService
    ) {
        $this->newsService = $newsService;
        $this->studentService = $studentService;
        $this->schoolService = $schoolService;
        $this->seoService = $seoService;
    }

    public function mount()
    {
        // Set SEO for homepage
        $this->seoService->setPageSeo(
            'Beranda - SMP Digital',
            'Website resmi SMP Digital - Sekolah Menengah Pertama unggul dalam prestasi dan berkarakter',
            asset('images/og-default.jpg')
        );
    }

    public function render()
    {
        $latestNews = $this->newsService->getLatestNews(4);
        $featuredAchievements = $this->studentService->getAchievements(null, 3);
        $currentYear = $this->studentService->getCurrentAcademicYear();
        $schoolProfile = $this->schoolService->getSchoolProfile();
        
        $stats = null;
        if ($currentYear) {
            $statistics = $this->studentService->getStudentStatistics($currentYear->id);
            $totalStudents = $statistics->sum(function($stat) {
                return $stat->male_count + $stat->female_count;
            });
            
            $employees = $this->schoolService->getEmployees('guru');
            $achievements = $this->studentService->getAchievements(null, null);
            
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
        ])->layout('components.app-layout');
    }
}
