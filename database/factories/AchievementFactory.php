<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    protected static array $achievements = [
        // Akademik
        [
            'title' => 'Juara 1 Olimpiade Matematika Tingkat Provinsi DKI Jakarta',
            'category' => 'akademik',
            'level' => 'provinsi',
            'rank' => 'Juara 1',
        ],
        [
            'title' => 'Juara 2 Olimpiade Sains Nasional (OSN) Bidang IPA',
            'category' => 'akademik',
            'level' => 'nasional',
            'rank' => 'Juara 2',
        ],
        [
            'title' => 'Juara 3 Lomba Cerdas Cermat Tingkat Kota Jakarta Pusat',
            'category' => 'akademik',
            'level' => 'kabupaten',
            'rank' => 'Juara 3',
        ],
        [
            'title' => 'Juara 1 Kompetisi Bahasa Inggris Tingkat Kecamatan',
            'category' => 'akademik',
            'level' => 'kecamatan',
            'rank' => 'Juara 1',
        ],
        [
            'title' => 'Medali Perak Olimpiade Matematika Internasional (IMO) Junior',
            'category' => 'akademik',
            'level' => 'internasional',
            'rank' => 'Medali Perak',
        ],
        // Olahraga
        [
            'title' => 'Juara 1 Turnamen Futsal Antar SMP Se-Jakarta',
            'category' => 'olahraga',
            'level' => 'provinsi',
            'rank' => 'Juara 1',
        ],
        [
            'title' => 'Juara 2 Lomba Renang POPDA Tingkat Provinsi',
            'category' => 'olahraga',
            'level' => 'provinsi',
            'rank' => 'Juara 2',
        ],
        [
            'title' => 'Juara 1 Kejuaraan Bulu Tangkis Tingkat Kota',
            'category' => 'olahraga',
            'level' => 'kabupaten',
            'rank' => 'Juara 1',
        ],
        [
            'title' => 'Juara 3 Lomba Lari Marathon Pelajar Tingkat Nasional',
            'category' => 'olahraga',
            'level' => 'nasional',
            'rank' => 'Juara 3',
        ],
        // Seni
        [
            'title' => 'Juara 1 Festival Seni Tari Tradisional Tingkat Provinsi',
            'category' => 'seni',
            'level' => 'provinsi',
            'rank' => 'Juara 1',
        ],
        [
            'title' => 'Juara 2 Lomba Paduan Suara Tingkat Nasional',
            'category' => 'seni',
            'level' => 'nasional',
            'rank' => 'Juara 2',
        ],
        [
            'title' => 'Juara 1 FLS2N Cabang Seni Lukis Tingkat Kota',
            'category' => 'seni',
            'level' => 'kabupaten',
            'rank' => 'Juara 1',
        ],
        [
            'title' => 'Juara Harapan 1 Festival Band Pelajar Se-Jabodetabek',
            'category' => 'seni',
            'level' => 'provinsi',
            'rank' => 'Juara Harapan 1',
        ],
        // Lainnya
        [
            'title' => 'Juara 1 Lomba Karya Tulis Ilmiah Remaja (LKIR) Tingkat Nasional',
            'category' => 'lainnya',
            'level' => 'nasional',
            'rank' => 'Juara 1',
        ],
        [
            'title' => 'Juara 2 Lomba Robot Kreatif Tingkat Provinsi',
            'category' => 'lainnya',
            'level' => 'provinsi',
            'rank' => 'Juara 2',
        ],
        [
            'title' => 'Finalis Kompetisi Sains Madrasah Tingkat Nasional',
            'category' => 'lainnya',
            'level' => 'nasional',
            'rank' => 'Finalis',
        ],
        [
            'title' => 'Juara 1 Pramuka Penggalang Tingkat Kwartir Cabang',
            'category' => 'lainnya',
            'level' => 'kabupaten',
            'rank' => 'Juara 1',
        ],
    ];

    protected static array $studentNames = [
        'Ahmad Rizky Pratama', 'Dian Safitri', 'Muhammad Farhan', 'Siti Nurhaliza',
        'Budi Setiawan', 'Anisa Rahma', 'Rendi Kurniawan', 'Dewi Lestari',
        'Kevin Wijaya', 'Putri Ayu Ningrum', 'Fadlan Hakim', 'Zahra Aulia',
        'Arif Rahman', 'Maya Sari', 'Gilang Ramadhan', 'Nadia Permata',
        'Fikri Haikal', 'Indah Cahyani', 'Dimas Prayoga', 'Salsa Nabila',
    ];

    protected static array $classes = ['7A', '7B', '7C', '8A', '8B', '8C', '9A', '9B', '9C'];

    public function definition(): array
    {
        $achievement = $this->faker->randomElement(self::$achievements);
        $imageId = $this->faker->numberBetween(100, 999);

        return [
            'title' => $achievement['title'],
            'description' => 'Prestasi membanggakan yang diraih oleh siswa-siswi SMP Negeri 1 Nusantara dalam ajang kompetisi tingkat ' . $achievement['level'] . '. Prestasi ini menunjukkan kualitas pendidikan dan pembinaan yang baik di sekolah kami.',
            'category' => $achievement['category'],
            'level' => $achievement['level'],
            'achievement_rank' => $achievement['rank'],
            'student_name' => $this->faker->randomElement(self::$studentNames),
            'student_class' => $this->faker->randomElement(self::$classes),
            'achievement_date' => $this->faker->dateTimeBetween('-3 years', 'now'),
            'image_path' => 'https://picsum.photos/seed/achievement' . $imageId . '/800/600',
            'created_by' => User::factory(),
            'is_published' => true,
        ];
    }
}
