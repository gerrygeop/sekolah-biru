<?php

namespace App\Livewire\Gallery;

use App\Services\GalleryService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Photos extends Component
{
    protected $galleryService;

    public function mount()
    {
        $this->galleryService = app(GalleryService::class);
        SEOMeta::setTitle('Galeri Foto - SMP Digital', false);
    }

    public function render()
    {
        return view('livewire.gallery.photos', [
            'photos' => $this->galleryService->getAllPhotos(12),
        ]);
    }
}
