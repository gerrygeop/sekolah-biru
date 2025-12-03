<?php

namespace App\Livewire\Profile;

use App\Services\SchoolProfileService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class VisionMission extends Component
{
    protected $schoolService;

    public function mount()
    {
        $this->schoolService = app(SchoolProfileService::class);

        SEOMeta::setTitle('Visi dan Misi - SMP Digital', false);
        SEOMeta::setDescription('Pelajari visi dan misi SMP Digital dalam menciptakan generasi muda yang berprestasi dan berkarakter.');
    }

    public function getSchoolProfile()
    {
        return $this->schoolService->getSchoolProfile();
    }

    public function hydrate()
    {
        $this->schoolService = $this->schoolService ?? app(SchoolProfileService::class);
    }

    public function render()
    {
        return view('livewire.profile.vision-mission', [
            'schoolProfile' => $this->getSchoolProfile(),
        ]);
    }
}
