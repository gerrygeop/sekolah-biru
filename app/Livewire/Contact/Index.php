<?php

namespace App\Livewire\Contact;

use Livewire\Component;
use App\Models\ContactInfo;
use Artesaos\SEOTools\Facades\SEOTools;

class Index extends Component
{
    public function mount()
    {
        SEOTools::setTitle('Kontak - SMP Digital', false);
        SEOTools::setDescription('Hubungi kami untuk informasi lebih lanjut tentang SMP Digital');
        SEOTools::opengraph()->setUrl(url()->current());
        SEOTools::opengraph()->addProperty('type', 'website');
    }

    public function render()
    {
        return view('livewire.contact.index', [
            'contact' => ContactInfo::first()
        ]);
    }
}
