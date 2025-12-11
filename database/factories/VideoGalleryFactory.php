<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VideoGallery>
 */
class VideoGalleryFactory extends Factory
{
    protected static array $videos = [
        [
            'title' => 'Profil SMP Negeri 1 Nusantara',
            'description' => 'Video profil lengkap SMP Negeri 1 Nusantara yang menampilkan visi misi, fasilitas, dan keunggulan sekolah.',
            'youtube_id' => 'dQw4w9WgXcQ',
        ],
        [
            'title' => 'Video Pembelajaran Matematika - Persamaan Linear',
            'description' => 'Materi pembelajaran matematika kelas 8 tentang persamaan linear satu variabel dengan penjelasan yang mudah dipahami.',
            'youtube_id' => 'JGwWNGJdvx8',
        ],
        [
            'title' => 'Dokumentasi Pentas Seni 2024',
            'description' => 'Rekaman lengkap pentas seni akhir tahun yang menampilkan tari tradisional, drama musikal, dan band siswa.',
            'youtube_id' => 'kJQP7kiw5Fk',
        ],
        [
            'title' => 'Tutorial Praktikum IPA - Fotosintesis',
            'description' => 'Panduan praktikum IPA tentang proses fotosintesis menggunakan daun dan air untuk siswa kelas 7.',
            'youtube_id' => 'fHI8X4OXluQ',
        ],
        [
            'title' => 'Wisuda Kelas 9 Tahun Ajaran 2023/2024',
            'description' => 'Momen istimewa wisuda dan perpisahan siswa kelas 9 yang telah menyelesaikan pendidikan di SMP.',
            'youtube_id' => '09R8_2nJtjg',
        ],
        [
            'title' => 'Kegiatan Pramuka - Kemah Bhakti',
            'description' => 'Dokumentasi kegiatan perkemahan Pramuka Penggalang dalam rangka Kemah Bhakti tahunan.',
            'youtube_id' => 'ZbZSe6N_BXs',
        ],
        [
            'title' => 'Study Tour Yogyakarta 2024',
            'description' => 'Perjalanan edukatif siswa kelas 8 ke Yogyakarta mengunjungi Candi Borobudur dan tempat bersejarah lainnya.',
            'youtube_id' => 'DyDfgMOUjCI',
        ],
        [
            'title' => 'Tips Sukses Ujian Nasional',
            'description' => 'Sharing pengalaman dari alumni berprestasi tentang tips dan trik menghadapi ujian nasional.',
            'youtube_id' => 'RgKAFK5djSk',
        ],
    ];

    protected static int $videoIndex = 0;

    public function definition(): array
    {
        $index = self::$videoIndex % count(self::$videos);
        $video = self::$videos[$index];
        self::$videoIndex++;

        return [
            'title' => $video['title'],
            'description' => $video['description'],
            'youtube_url' => 'https://www.youtube.com/watch?v=' . $video['youtube_id'],
            'youtube_id' => $video['youtube_id'],
            'thumbnail_url' => 'https://img.youtube.com/vi/' . $video['youtube_id'] . '/hqdefault.jpg',
            'video_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'created_by' => User::factory(),
            'order' => $index + 1,
            'is_published' => true,
        ];
    }

    public static function resetIndex(): void
    {
        self::$videoIndex = 0;
    }
}
