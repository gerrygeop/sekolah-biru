<?php

namespace App\Livewire\Profile;

use App\Services\SchoolProfileService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Organization extends Component
{
    protected $schoolService;

    public function mount()
    {
        $this->schoolService = app(SchoolProfileService::class);

        SEOMeta::setTitle('Struktur Organisasi - SMP Digital', false);
        SEOMeta::setDescription('Lihat struktur organisasi SMP Digital yang terdiri dari berbagai divisi dan tim yang mendukung operasional sekolah.');
    }

    public function render()
    {
        return view('livewire.profile.organization', [
            'organization' => $this->schoolService->getOrganizationStructure(),
        ]);
    }
}
