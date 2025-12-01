<?php

namespace App\Services;

use App\Models\AcademicYear;
use App\Models\StudentStatistic;
use App\Models\Achievement;
use App\Models\Alumni;
use App\Models\AlumniDistribution;
use Illuminate\Support\Facades\Cache;

class StudentService
{
    public function getCurrentAcademicYear()
    {
        return Cache::remember('current_academic_year', 86400, function () {
            return AcademicYear::active()->first();
        });
    }

    public function getStudentStatistics($academicYearId = null)
    {
        $yearId = $academicYearId ?? optional($this->getCurrentAcademicYear())->id;
        
        if (!$yearId) return collect();

        return Cache::remember("student_statistics_{$yearId}", 3600, function () use ($yearId) {
            return StudentStatistic::where('academic_year_id', $yearId)
                ->orderBy('grade')
                ->get();
        });
    }

    public function getAchievements($category = null, $limit = 6)
    {
        $query = Achievement::published()->latest('achievement_date');

        if ($category) {
            $query->where('category', $category);
        }

        return $query->limit($limit)->get();
    }

    public function getAllAchievements($perPage = 12, $category = null)
    {
        $query = Achievement::published()->latest('achievement_date');

        if ($category) {
            $query->where('category', $category);
        }

        return $query->paginate($perPage);
    }

    public function getFeaturedAlumni($limit = 3)
    {
        return Cache::remember('featured_alumni', 3600, function () use ($limit) {
            return Alumni::featured()
                ->latest()
                ->limit($limit)
                ->get();
        });
    }

    public function getAllAlumni($perPage = 12)
    {
        return Alumni::latest()->paginate($perPage);
    }

    public function getAlumniDistribution($academicYearId = null)
    {
        $yearId = $academicYearId ?? optional($this->getCurrentAcademicYear())->id;
        
        if (!$yearId) return collect();

        return AlumniDistribution::where('academic_year_id', $yearId)->get();
    }
}
