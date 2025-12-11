<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhotoGallery>
 */
class PhotoGalleryFactory extends Factory
{
    protected static array $photoEvents = [
        ['title' => 'Upacara Bendera Hari Senin', 'description' => 'Dokumentasi upacara bendera rutin setiap hari Senin sebagai bagian dari pembiasaan kedisiplinan dan cinta tanah air.'],
        ['title' => 'Kegiatan Belajar Mengajar di Kelas', 'description' => 'Suasana pembelajaran aktif dan interaktif di ruang kelas dengan metode student-centered learning.'],
        ['title' => 'Praktikum di Laboratorium IPA', 'description' => 'Siswa melakukan eksperimen sains di laboratorium IPA untuk memahami konsep pembelajaran secara praktis.'],
        ['title' => 'Lomba 17 Agustus - Peringatan Kemerdekaan', 'description' => 'Rangkaian lomba dalam rangka memperingati Hari Kemerdekaan Republik Indonesia.'],
        ['title' => 'Pentas Seni Akhir Tahun', 'description' => 'Pertunjukan bakat dan kreativitas siswa dalam ajang pentas seni tutup tahun ajaran.'],
        ['title' => 'Kegiatan Pramuka Penggalang', 'description' => 'Kegiatan kepramukaan sebagai wadah pembentukan karakter dan jiwa kepemimpinan siswa.'],
        ['title' => 'Kunjungan Industri dan Study Tour', 'description' => 'Siswa mengunjungi berbagai tempat edukatif sebagai bagian dari pembelajaran di luar kelas.'],
        ['title' => 'Kegiatan Ekstrakurikuler Olahraga', 'description' => 'Latihan rutin ekstrakurikuler futsal, basket, dan voli yang dibimbing oleh pelatih berpengalaman.'],
        ['title' => 'Kegiatan OSIS dan MPK', 'description' => 'Rapat dan kegiatan organisasi siswa sebagai wadah pengembangan leadership dan soft skills.'],
        ['title' => 'Perayaan Hari Guru Nasional', 'description' => 'Siswa memberikan apresiasi kepada para guru dalam peringatan Hari Guru Nasional 25 November.'],
        ['title' => 'Class Meeting Semester Ganjil', 'description' => 'Berbagai lomba antar kelas yang diselenggarakan setelah ujian semester ganjil.'],
        ['title' => 'Wisuda dan Perpisahan Kelas 9', 'description' => 'Momen wisuda dan perpisahan siswa kelas 9 yang telah menyelesaikan studinya di SMP.'],
        ['title' => 'Kegiatan Literasi di Perpustakaan', 'description' => 'Program pembiasaan membaca di perpustakaan sekolah untuk meningkatkan minat baca siswa.'],
        ['title' => 'Senam Pagi Bersama', 'description' => 'Kegiatan senam pagi rutin setiap Jumat untuk menjaga kebugaran dan kesehatan warga sekolah.'],
        ['title' => 'Pelantikan Pengurus OSIS Baru', 'description' => 'Upacara pelantikan pengurus OSIS periode baru sebagai estafet kepemimpinan organisasi siswa.'],
    ];

    protected static int $photoIndex = 0;

    public function definition(): array
    {
        $index = self::$photoIndex % count(self::$photoEvents);
        $event = self::$photoEvents[$index];
        self::$photoIndex++;

        $imageId = $this->faker->numberBetween(100, 999);
        $imageUrl = 'https://picsum.photos/seed/gallery' . $imageId . '/800/600';
        $thumbnailUrl = 'https://picsum.photos/seed/gallery' . $imageId . '/400/300';

        return [
            'title' => $event['title'],
            'description' => $event['description'],
            'image_path' => $imageUrl,
            'thumbnail_path' => $thumbnailUrl,
            'photo_date' => $this->faker->dateTimeBetween('-2 years', 'now'),
            'created_by' => User::factory(),
            'order' => $index + 1,
            'is_published' => true,
        ];
    }

    public static function resetIndex(): void
    {
        self::$photoIndex = 0;
    }
}
