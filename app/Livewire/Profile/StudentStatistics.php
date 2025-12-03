<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Services\StudentService;
use App\Models\AcademicYear;

class StudentStatistics extends Component
{
    public $selectedYearId = null;

    protected $studentService;

    public function mount()
    {
        $this->studentService = app(StudentService::class);

        // Set default year to current academic year
        if (!$this->selectedYearId) {
            $currentYear = $this->studentService->getCurrentAcademicYear();
            if ($currentYear) {
                $this->selectedYearId = $currentYear->id;
            }
        }
    }

    public function setYear($yearId)
    {
        $this->selectedYearId = $yearId;
    }

    public function getAcademicYears()
    {
        return AcademicYear::orderBy('year', 'desc')->get();
    }

    public function getCurrentYear()
    {
        return $this->studentService->getCurrentAcademicYear();
    }

    public function getStatistics()
    {
        $yearId = $this->selectedYearId ?? $this->getCurrentYear()?->id;
        if (!$yearId) {
            return collect();
        }
        return $this->studentService->getStudentStatistics($yearId);
    }

    public function getTotalStats()
    {
        $stats = $this->getStatistics();
        return [
            'total' => $stats->sum(fn($s) => $s->male_count + $s->female_count),
            'male' => $stats->sum('male_count'),
            'female' => $stats->sum('female_count'),
        ];
    }

    public function hydrate()
    {
        $this->studentService = $this->studentService ?? app(StudentService::class);
    }

    public function render()
    {
        return view('livewire.profile.student-statistics', [
            'academicYears' => $this->getAcademicYears(),
            'currentYear' => $this->getCurrentYear(),
            'statistics' => $this->getStatistics(),
            'totalStats' => $this->getTotalStats(),
        ]);
    }
}
