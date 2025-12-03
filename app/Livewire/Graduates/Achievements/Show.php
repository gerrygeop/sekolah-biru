<?php

namespace App\Livewire\Graduates\Achievements;

use App\Models\Achievement;
use Artesaos\SEOTools\Facades\SEOMeta;
use Livewire\Component;

class Show extends Component
{
    public $achievement;

    public function mount(Achievement $achievement)
    {
        $this->achievement = $achievement;
        SEOMeta::setTitle($achievement->title . ' - Prestasi Alumni - SMP Digital', false);
        SEOMeta::setDescription(substr(strip_tags($achievement->description), 0, 160));
    }

    public function getRelatedAchievements()
    {
        return Achievement::where('id', '!=', $this->achievement->id)
            ->where('category', $this->achievement->category)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        return view('livewire.graduates.achievements.show', [
            'relatedAchievements' => $this->getRelatedAchievements(),
        ]);
    }
}
