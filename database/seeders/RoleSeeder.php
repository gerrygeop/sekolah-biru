<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create roles
        $adminRole = Role::firstOrCreate(['name' => 'super_admin', 'guard_name' => 'web']);
        $staffRole = Role::firstOrCreate(['name' => 'staff', 'guard_name' => 'web']);
        $petinggiRole = Role::firstOrCreate(['name' => 'petinggi', 'guard_name' => 'web']);

        // Admin gets all permissions
        $adminRole->givePermissionTo(Permission::all());

        // Staff permissions - can manage content
        $staffPermissions = [
            // News
            'view_news', 'view_any_news', 'create_news', 'update_news', 'delete_news',
            'view_news::category', 'view_any_news::category',
            
            // Gallery
            'view_photo::gallery', 'view_any_photo::gallery', 'create_photo::gallery', 'update_photo::gallery', 'delete_photo::gallery',
            'view_video::gallery', 'view_any_video::gallery', 'create_video::gallery', 'update_video::gallery', 'delete_video::gallery',
            
            // Student Data
            'view_student::statistic', 'view_any_student::statistic', 'create_student::statistic', 'update_student::statistic', 'delete_student::statistic',
            
            // Achievements
            'view_achievement', 'view_any_achievement', 'create_achievement', 'update_achievement', 'delete_achievement',
            
            // Alumni
            'view_alumni', 'view_any_alumni', 'create_alumni', 'update_alumni', 'delete_alumni',
            'view_alumni::distribution', 'view_any_alumni::distribution', 'create_alumni::distribution', 'update_alumni::distribution', 'delete_alumni::distribution',
            
            // Virtual Class
            'view_virtual::class', 'view_any_virtual::class', 'create_virtual::class', 'update_virtual::class', 'delete_virtual::class',
        ];

        foreach ($staffPermissions as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            $staffRole->givePermissionTo($perm);
        }

        // Petinggi permissions - read-only access to statistics
        $petinggiPermissions = [
            'view_student::statistic', 'view_any_student::statistic',
            'view_achievement', 'view_any_achievement',
            'view_alumni', 'view_any_alumni',
            'view_alumni::distribution', 'view_any_alumni::distribution',
            'view_academic::year', 'view_any_academic::year',
        ];

        foreach ($petinggiPermissions as $permission) {
            $perm = Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            $petinggiRole->givePermissionTo($perm);
        }
    }
}
