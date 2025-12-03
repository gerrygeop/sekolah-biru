<?php

namespace App\Services;

use App\Models\SchoolProfile;
use App\Models\OrganizationStructure;
use App\Models\Employee;
use App\Models\Facility;
use Illuminate\Support\Facades\Cache;

class SchoolProfileService
{
    public function getSchoolProfile()
    {
        return Cache::remember('school_profile', 86400, function () {
            return SchoolProfile::first();
        });
    }

    public function getOrganizationStructure()
    {
        return Cache::remember('organization_structure', 86400, function () {
            return OrganizationStructure::active()
                ->ordered()
                ->get();
        });
    }

    public function getEmployees($type = null)
    {
        $query = Employee::active()->orderBy('join_date', 'asc');

        if ($type) {
            $query->where('type', $type);
        }

        return $query->get();
    }

    public function getFacilities()
    {
        return Cache::remember('facilities', 86400, function () {
            return Facility::with('images')
                ->where('is_published', true)
                ->orderBy('order')
                ->get();
        });
    }

    public function clearProfileCache()
    {
        Cache::forget('school_profile');
        Cache::forget('organization_structure');
        Cache::forget('facilities');
    }
}
