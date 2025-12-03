<?php

namespace App\Livewire\Graduates;

use Livewire\Component;
use App\Services\StudentService;
use App\Models\AcademicYear;
use Artesaos\SEOTools\Facades\SEOMeta;

class AlumniDistribution extends Component
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

        SEOMeta::setTitle('Distribusi Alumni - SMP Digital', false);
        SEOMeta::setDescription('Lihat distribusi alumni SMP Digital berdasarkan jenjang pendidikan lanjutan yang mereka pilih setelah lulus.');
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

    public function getDistribution()
    {
        $yearId = $this->selectedYearId ?? $this->getCurrentYear()?->id;
        if (!$yearId) {
            return collect();
        }
        return $this->studentService->getAlumniDistribution($yearId);
    }

    public function getGroupedDistribution()
    {
        return $this->getDistribution()->groupBy('school_type');
    }

    public function hydrate()
    {
        $this->studentService = $this->studentService ?? app(StudentService::class);
    }

    public function render()
    {
        return view('livewire.graduates.alumni-distribution', [
            'academicYears' => $this->getAcademicYears(),
            'currentYear' => $this->getCurrentYear(),
            'distribution' => $this->getDistribution(),
            'groupedDistribution' => $this->getGroupedDistribution(),
        ]);
    }
}
