<?php

namespace App\Livewire\Gallery;

use App\Services\GalleryService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Videos extends Component
{
    protected $galleryService;

    public function mount()
    {
        $this->galleryService = app(GalleryService::class);
        SEOMeta::setTitle('Galeri Video - SMP Digital', false);
    }

    public function render()
    {
        return view('livewire.gallery.videos', [
            'videos' => $this->galleryService->getAllVideos(12),
        ]);
    }
}
