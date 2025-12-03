<?php

namespace App\Livewire\Graduates\Achievements;

use Livewire\Component;
use App\Services\StudentService;
use App\Models\Achievement;
use Artesaos\SEOTools\Facades\SEOMeta;

class Index extends Component
{
    public $selectedCategory = null;

    protected $studentService;

    public function mount()
    {
        $this->studentService = app(StudentService::class);

        SEOMeta::setTitle('Prestasi Alumni - SMP Digital', false);
        SEOMeta::setDescription('Lihat berbagai prestasi yang telah diraih oleh para alumni SMP Digital di berbagai bidang.');
    }

    public function setCategory($category)
    {
        $this->selectedCategory = $category;
    }

    public function getAchievements()
    {
        return $this->studentService->getAllAchievements(12, $this->selectedCategory);
    }

    public function getCategories()
    {
        return Achievement::select('category')->distinct()->pluck('category');
    }

    public function hydrate()
    {
        $this->studentService = $this->studentService ?? app(StudentService::class);
    }

    public function render()
    {
        return view('livewire.graduates.achievements.index', [
            'achievements' => $this->getAchievements(),
            'categories' => $this->getCategories(),
        ]);
    }
}
