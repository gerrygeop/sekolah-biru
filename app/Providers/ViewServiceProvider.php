<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache;
use App\Models\SchoolProfile;
use App\Models\ContactInfo;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Share global data with all views using caching
        View::composer('*', function ($view) {
            // Cache school profile for 1 hour
            $schoolProfile = Cache::remember('school_profile', 3600, function () {
                return SchoolProfile::first();
            });

            // Cache contact info for 1 hour
            $contactInfo = Cache::remember('contact_info', 3600, function () {
                return ContactInfo::first();
            });

            $view->with([
                'globalSchoolProfile' => $schoolProfile,
                'globalContactInfo' => $contactInfo,
            ]);
        });
    }
}
