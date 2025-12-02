<?php

namespace App\Livewire\Home;

use Livewire\Component;
use App\Services\NewsService;
use App\Services\StudentService;
use App\Services\SchoolProfileService;

class Index extends Component
{
    protected $newsService;
    protected $studentService;
    protected $schoolService;

    public function boot(
        NewsService $newsService,
        StudentService $studentService,
        SchoolProfileService $schoolService
    ) {
        $this->newsService = $newsService;
        $this->studentService = $studentService;
        $this->schoolService = $schoolService;
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
