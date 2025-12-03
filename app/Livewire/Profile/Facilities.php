<?php

namespace App\Livewire\Profile;

use App\Services\SchoolProfileService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Facilities extends Component
{
    protected $schoolService;

    public function mount()
    {
        $this->schoolService = app(SchoolProfileService::class);
        SEOMeta::setTitle('Fasilitas Sekolah - SMP Digital', false);
    }

    public function render()
    {
        return view('livewire.profile.facilities', [
            'facilities' => $this->schoolService->getFacilities(),
        ]);
    }
}
