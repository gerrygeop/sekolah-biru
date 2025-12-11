<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\SchoolProfile;
use App\Models\ContactInfo;
use App\Models\SeoSetting;
use App\Models\OrganizationStructure;
use App\Models\Employee;
use App\Models\Facility;
use App\Models\AcademicYear;
use App\Models\StudentStatistic;
use App\Models\Achievement;
use App\Models\Alumni;
use App\Models\AlumniDistribution;
use App\Models\VirtualClass;
use App\Models\PhotoGallery;
use App\Models\VideoGallery;
use App\Models\NewsCategory;
use App\Models\News;
use Database\Factories\OrganizationStructureFactory;
use Database\Factories\FacilityFactory;
use Database\Factories\PhotoGalleryFactory;
use Database\Factories\VideoGalleryFactory;
use Database\Factories\VirtualClassFactory;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Reset factory indexes
        OrganizationStructureFactory::resetIndex();
        FacilityFactory::resetIndex();
        PhotoGalleryFactory::resetIndex();
        VideoGalleryFactory::resetIndex();
        VirtualClassFactory::resetIndex();

        // Seed Roles and Permissions first
        $this->call(SpatiePermissionsSeeder::class);

        // Get roles
        $adminRole = Role::where('name', 'super_admin')->first();
        $staffRole = Role::where('name', 'staff')->first();

        // Create Admin User
        $admin = User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@smpn1nusantara.sch.id',
            'password' => bcrypt('password'),
        ]);
        $admin->assignRole($adminRole);

        // Create Staff User
        $staff = User::factory()->create([
            'name' => 'Staff Tata Usaha',
            'email' => 'tatauhasa@smpn1nusantara.sch.id',
            'password' => bcrypt('password'),
        ]);
        $staff->assignRole($staffRole);

        // Create School Profile (singleton)
        SchoolProfile::factory()->create();

        // Create Contact Info (singleton) - synced with School Profile
        ContactInfo::factory()->create();

        // Create SEO Settings for all pages
        $seoPages = [
            ['page_name' => 'home', 'meta_title' => 'Beranda - SMP Negeri 1 Nusantara', 'meta_description' => 'Website resmi SMP Negeri 1 Nusantara - Sekolah unggulan dengan prestasi akademik dan non-akademik tingkat nasional.'],
            ['page_name' => 'profile.vision-mission', 'meta_title' => 'Visi & Misi - SMP Negeri 1 Nusantara', 'meta_description' => 'Visi dan misi SMP Negeri 1 Nusantara dalam menciptakan siswa berprestasi dan berkarakter.'],
            ['page_name' => 'profile.organization', 'meta_title' => 'Struktur Organisasi - SMP Negeri 1 Nusantara', 'meta_description' => 'Struktur organisasi dan jajaran pimpinan SMP Negeri 1 Nusantara.'],
            ['page_name' => 'profile.staff', 'meta_title' => 'Tenaga Pendidik - SMP Negeri 1 Nusantara', 'meta_description' => 'Daftar guru dan staff tenaga kependidikan SMP Negeri 1 Nusantara.'],
            ['page_name' => 'profile.facilities', 'meta_title' => 'Fasilitas - SMP Negeri 1 Nusantara', 'meta_description' => 'Fasilitas lengkap SMP Negeri 1 Nusantara untuk mendukung kegiatan belajar mengajar.'],
            ['page_name' => 'profile.students', 'meta_title' => 'Data Siswa - SMP Negeri 1 Nusantara', 'meta_description' => 'Statistik dan data siswa SMP Negeri 1 Nusantara.'],
            ['page_name' => 'graduates.achievements', 'meta_title' => 'Prestasi - SMP Negeri 1 Nusantara', 'meta_description' => 'Prestasi membanggakan siswa SMP Negeri 1 Nusantara di berbagai ajang kompetisi.'],
            ['page_name' => 'graduates.alumni', 'meta_title' => 'Alumni - SMP Negeri 1 Nusantara', 'meta_description' => 'Data alumni dan testimoni lulusan SMP Negeri 1 Nusantara.'],
            ['page_name' => 'news', 'meta_title' => 'Berita - SMP Negeri 1 Nusantara', 'meta_description' => 'Berita dan informasi terbaru dari SMP Negeri 1 Nusantara.'],
            ['page_name' => 'contact', 'meta_title' => 'Kontak - SMP Negeri 1 Nusantara', 'meta_description' => 'Informasi kontak dan lokasi SMP Negeri 1 Nusantara.'],
        ];
        foreach ($seoPages as $seo) {
            SeoSetting::create($seo);
        }

        // Create Organization Structure (10 positions)
        OrganizationStructure::factory()->count(10)->create();

        // Create Employees (30 teachers, 10 staff)
        // Teachers with their specific subjects
        $teacherSubjects = [
            'Matematika', 'Matematika', 'Bahasa Indonesia', 'Bahasa Indonesia',
            'Bahasa Inggris', 'Bahasa Inggris', 'IPA (Fisika)', 'IPA (Fisika)',
            'IPA (Biologi)', 'IPA (Biologi)', 'IPS (Sejarah)', 'IPS (Geografi)',
            'PKn', 'Pendidikan Agama Islam', 'Pendidikan Agama Kristen',
            'Seni Budaya', 'Seni Budaya', 'PJOK', 'PJOK', 'Prakarya',
            'TIK', 'TIK', 'Bahasa Jawa', 'BK', 'BK',
            'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA (Fisika)', 'IPS (Sejarah)',
        ];

        foreach ($teacherSubjects as $subject) {
            Employee::factory()->teacher()->create(['subject' => $subject]);
        }

        // Staff
        Employee::factory()->staff()->count(10)->create();

        // Create Facilities (15 facilities)
        Facility::factory()->count(15)->create();

        // Create Academic Years (5 years: 2020/2021 - 2024/2025)
        $academicYears = [
            ['year' => '2020/2021', 'is_active' => false],
            ['year' => '2021/2022', 'is_active' => false],
            ['year' => '2022/2023', 'is_active' => false],
            ['year' => '2023/2024', 'is_active' => false],
            ['year' => '2024/2025', 'is_active' => true],
        ];

        $studentDataByYear = [
            '2020/2021' => [
                '7' => ['male' => 120, 'female' => 128, 'classes' => 8],
                '8' => ['male' => 115, 'female' => 122, 'classes' => 7],
                '9' => ['male' => 110, 'female' => 118, 'classes' => 7],
            ],
            '2021/2022' => [
                '7' => ['male' => 125, 'female' => 130, 'classes' => 8],
                '8' => ['male' => 118, 'female' => 125, 'classes' => 8],
                '9' => ['male' => 113, 'female' => 120, 'classes' => 7],
            ],
            '2022/2023' => [
                '7' => ['male' => 128, 'female' => 132, 'classes' => 8],
                '8' => ['male' => 122, 'female' => 128, 'classes' => 8],
                '9' => ['male' => 116, 'female' => 123, 'classes' => 8],
            ],
            '2023/2024' => [
                '7' => ['male' => 130, 'female' => 135, 'classes' => 8],
                '8' => ['male' => 126, 'female' => 130, 'classes' => 8],
                '9' => ['male' => 120, 'female' => 126, 'classes' => 8],
            ],
            '2024/2025' => [
                '7' => ['male' => 135, 'female' => 140, 'classes' => 8],
                '8' => ['male' => 128, 'female' => 133, 'classes' => 8],
                '9' => ['male' => 124, 'female' => 128, 'classes' => 8],
            ],
        ];

        foreach ($academicYears as $yearData) {
            $academicYear = AcademicYear::factory()->create($yearData);
            
            // Create student statistics for each grade
            $yearStats = $studentDataByYear[$yearData['year']];
            foreach ($yearStats as $grade => $stats) {
                StudentStatistic::factory()->create([
                    'academic_year_id' => $academicYear->id,
                    'grade' => (string) $grade,
                    'male_count' => $stats['male'],
                    'female_count' => $stats['female'],
                    'total_classes' => $stats['classes'],
                ]);
            }

            // Create alumni distribution for completed years
            if (!$yearData['is_active']) {
                $distributions = [
                    ['school_name' => 'SMAN 1 Jakarta', 'school_type' => 'sma', 'student_count' => rand(25, 40)],
                    ['school_name' => 'SMAN 3 Jakarta', 'school_type' => 'sma', 'student_count' => rand(20, 35)],
                    ['school_name' => 'SMAN 8 Jakarta', 'school_type' => 'sma', 'student_count' => rand(15, 30)],
                    ['school_name' => 'SMKN 1 Jakarta', 'school_type' => 'smk', 'student_count' => rand(20, 35)],
                    ['school_name' => 'SMKN 4 Jakarta', 'school_type' => 'smk', 'student_count' => rand(15, 25)],
                    ['school_name' => 'MAN 1 Jakarta', 'school_type' => 'ma', 'student_count' => rand(10, 20)],
                    ['school_name' => 'Sekolah Lainnya', 'school_type' => 'lainnya', 'student_count' => rand(20, 40)],
                ];

                foreach ($distributions as $dist) {
                    AlumniDistribution::create([
                        'academic_year_id' => $academicYear->id,
                        'school_name' => $dist['school_name'],
                        'school_type' => $dist['school_type'],
                        'student_count' => $dist['student_count'],
                    ]);
                }
            }
        }

        // Create Achievements (15 achievements)
        Achievement::factory()->count(15)->create(['created_by' => $admin->id]);

        // Create Alumni (25 alumni)
        Alumni::factory()->count(25)->create();

        // Create Virtual Classes (12 classes)
        VirtualClass::factory()->count(12)->create(['created_by' => $staff->id]);

        // Create Galleries
        PhotoGallery::factory()->count(15)->create(['created_by' => $staff->id]);
        VideoGallery::factory()->count(8)->create(['created_by' => $staff->id]);

        // Create News Categories & News
        $categories = [
            ['name' => 'Agenda Sekolah', 'slug' => 'agenda-sekolah'],
            ['name' => 'Pengumuman', 'slug' => 'pengumuman'],
            ['name' => 'PPDB', 'slug' => 'ppdb'],
            ['name' => 'Info Lainnya', 'slug' => 'info-lainnya'],
        ];

        foreach ($categories as $categoryData) {
            $category = NewsCategory::factory()->create($categoryData);
            News::factory()->count(5)->create([
                'category_id' => $category->id,
                'author_id' => $admin->id,
            ]);
        }
    }
}
