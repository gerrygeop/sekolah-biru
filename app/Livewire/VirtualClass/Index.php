<?php

namespace App\Livewire\VirtualClass;

use Livewire\Component;
use App\Models\VirtualClass;
use Artesaos\SEOTools\Facades\SEOTools;

class Index extends Component
{
    public $selectedGrade = null;

    public function mount()
    {
        SEOTools::setTitle('Kelas Virtual - SMP Digital', false);
        SEOTools::setDescription('Materi pembelajaran dan sumber belajar online');
    }

    public function setGrade($grade)
    {
        $this->selectedGrade = $this->normalizeGrade($grade);
    }

    public function getVirtualClasses()
    {
        $grade = $this->selectedGrade;

        $query = VirtualClass::published();

        if ($grade !== null) {
            $query->where('grade', $grade);
        }

        return $query->orderBy('order')->get();
    }


    protected function normalizeGrade($grade)
    {
        if ($grade === null) {
            return null;
        }

        if (is_string($grade)) {
            $trim = trim($grade);

            if ($trim === '' || strtolower($trim) === 'null') {
                return null;
            }

            return $trim;
        }

        if (is_numeric($grade)) {
            return strval($grade);
        }

        return $grade;
    }

    public function render()
    {
        return view('livewire.virtual-class.index', [
            'virtualClasses' => $this->getVirtualClasses(),
        ]);
    }
}
