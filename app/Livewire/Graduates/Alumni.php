<?php

namespace App\Livewire\Graduates;

use App\Services\StudentService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Alumni extends Component
{
    protected $studentService;

    public function mount()
    {
        $this->studentService = app(StudentService::class);

        SEOMeta::setTitle('Alumni - SMP Digital', false);
    }

    public function render()
    {
        return view('livewire.graduates.alumni', [
            'allAlumni' => $this->studentService->getAllAlumni(),
        ]);
    }
}
