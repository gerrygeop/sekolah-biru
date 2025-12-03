<?php

namespace App\Livewire\Profile;

use Livewire\Component;
use App\Services\SchoolProfileService;
use Artesaos\SEOTools\Facades\SEOTools;

class Staff extends Component
{
    public $selectedType = 'all';

    protected $schoolService;

    public function mount()
    {
        $this->schoolService = app(SchoolProfileService::class);
        SEOTools::setTitle('Tenaga Pendidik - SMP Digital', false);
        SEOTools::setDescription('Guru dan staff yang berdedikasi untuk pendidikan terbaik di SMP Digital');
    }

    public function setType($type)
    {
        $this->selectedType = $type;
    }

    public function getEmployees()
    {
        $type = $this->selectedType === 'all' ? null : $this->selectedType;
        $schoolService = $this->schoolService ?? app(SchoolProfileService::class);
        return $schoolService->getEmployees($type);
    }

    public function render()
    {
        return view('livewire.profile.staff', [
            'employees' => $this->getEmployees(),
        ]);
    }
}
