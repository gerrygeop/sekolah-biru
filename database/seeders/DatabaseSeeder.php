<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SchoolProfile;
use App\Models\OrganizationStructure;
use App\Models\Employee;
use App\Models\Facility;
use App\Models\AcademicYear;
use App\Models\StudentStatistic;
use App\Models\Achievement;
use App\Models\Alumni;
use App\Models\VirtualClass;
use App\Models\PhotoGallery;
use App\Models\VideoGallery;
use App\Models\NewsCategory;
use App\Models\News;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Seed Roles and Permissions first
        $this->call(RoleSeeder::class);
        
        // Get roles
        $adminRole = Role::where('name', 'super_admin')->first();
        $staffRole = Role::where('name', 'staff')->first();

        // Create Admin User
        $admin = User::factory()->create([
            'name' => 'Admin Sekolah',
            'email' => 'admin@sekolah.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);
        $admin->assignRole($adminRole);

        // Create Staff User
        $staff = User::factory()->create([
            'name' => 'Staff Sekolah',
            'email' => 'staff@sekolah.com',
            'password' => bcrypt('password'),
            'role' => 'staff',
            'is_active' => true,
        ]);
        $staff->assignRole($staffRole);

        // Create School Profile
        SchoolProfile::factory()->create([
            'school_name' => 'SMP Negeri 1 Digital',
            'vision' => 'Menjadi sekolah unggul dalam prestasi dan berkarakter.',
            'mission' => "1. Meningkatkan kualitas pembelajaran.\n2. Mengembangkan potensi siswa.\n3. Menanamkan nilai-nilai karakter.",
        ]);

        // Create Organization Structure
        OrganizationStructure::factory()->count(5)->create();

        // Create Employees
        Employee::factory()->count(20)->create();

        // Create Facilities
        Facility::factory()->count(10)->create();

        // Create Academic Years & Statistics
        $academicYear = AcademicYear::factory()->create([
            'year' => '2024/2025',
            'is_active' => true,
        ]);

        StudentStatistic::factory()->create(['academic_year_id' => $academicYear->id, 'grade' => '7']);
        StudentStatistic::factory()->create(['academic_year_id' => $academicYear->id, 'grade' => '8']);
        StudentStatistic::factory()->create(['academic_year_id' => $academicYear->id, 'grade' => '9']);

        // Create Achievements
        Achievement::factory()->count(10)->create(['created_by' => $admin->id]);

        // Create Alumni
        Alumni::factory()->count(15)->create();

        // Create Virtual Classes
        VirtualClass::factory()->count(6)->create(['created_by' => $staff->id]);

        // Create Galleries
        PhotoGallery::factory()->count(12)->create(['created_by' => $staff->id]);
        VideoGallery::factory()->count(4)->create(['created_by' => $staff->id]);

        // Create News Categories & News
        $categories = ['Agenda Sekolah', 'Pengumuman', 'PPDB', 'Info Lain'];
        foreach ($categories as $category) {
            $cat = NewsCategory::factory()->create(['name' => $category]);
            News::factory()->count(5)->create([
                'category_id' => $cat->id,
                'author_id' => $admin->id,
            ]);
        }
    }
}
