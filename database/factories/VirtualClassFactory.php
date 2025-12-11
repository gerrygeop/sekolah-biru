<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VirtualClass>
 */
class VirtualClassFactory extends Factory
{
    protected static array $virtualClasses = [
        // Kelas 7
        ['grade' => '7', 'class_name' => '7A', 'title' => 'Matematika - Bilangan Bulat', 'description' => 'Materi pembelajaran bilangan bulat meliputi penjumlahan, pengurangan, perkalian, dan pembagian bilangan bulat.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/MTIzNDU2'],
        ['grade' => '7', 'class_name' => '7A', 'title' => 'Bahasa Indonesia - Teks Deskripsi', 'description' => 'Pembelajaran tentang struktur dan kebahasaan teks deskripsi serta praktik menulis teks deskripsi.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/NjU0MzIx'],
        ['grade' => '7', 'class_name' => '7B', 'title' => 'IPA - Klasifikasi Makhluk Hidup', 'description' => 'Materi tentang prinsip-prinsip klasifikasi makhluk hidup dan taksonomi dalam biologi.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/Nzg5MTIz'],
        ['grade' => '7', 'class_name' => '7B', 'title' => 'IPS - Interaksi Sosial', 'description' => 'Pembelajaran mengenai bentuk-bentuk interaksi sosial dalam kehidupan masyarakat.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/MTExMjIz'],
        
        // Kelas 8
        ['grade' => '8', 'class_name' => '8A', 'title' => 'Matematika - Persamaan Linear', 'description' => 'Materi PLSV dan PTLSV meliputi penyelesaian persamaan dan penerapan dalam kehidupan sehari-hari.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/MjIyMzMz'],
        ['grade' => '8', 'class_name' => '8A', 'title' => 'Bahasa Inggris - Narrative Text', 'description' => 'Pembelajaran struktur dan unsur kebahasaan narrative text serta analisis cerita rakyat.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/MzMzNDQ0'],
        ['grade' => '8', 'class_name' => '8B', 'title' => 'IPA - Sistem Gerak pada Manusia', 'description' => 'Mempelajari organ-organ penyusun sistem gerak dan mekanisme kerja otot dan tulang.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/NDQ0NTU1'],
        ['grade' => '8', 'class_name' => '8B', 'title' => 'TIK - Pengolahan Data dengan Spreadsheet', 'description' => 'Praktik menggunakan Microsoft Excel untuk pengolahan data dan pembuatan grafik.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/NTU1NjY2'],
        
        // Kelas 9
        ['grade' => '9', 'class_name' => '9A', 'title' => 'Matematika - Kesebangunan dan Kekongruenan', 'description' => 'Materi geometri tentang sifat-sifat kesebangunan dan kekongruenan bangun datar.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/NjY2Nzc3'],
        ['grade' => '9', 'class_name' => '9A', 'title' => 'Bahasa Indonesia - Teks Persuasi', 'description' => 'Pembelajaran menulis teks persuasi yang efektif dan memahami struktur kebahasaannya.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/Nzc3ODg4'],
        ['grade' => '9', 'class_name' => '9B', 'title' => 'IPA - Listrik Statis dan Dinamis', 'description' => 'Memahami konsep kelistrikan statis dan dinamis serta penerapannya dalam teknologi.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/ODg4OTk5'],
        ['grade' => '9', 'class_name' => '9B', 'title' => 'Persiapan Ujian Nasional', 'description' => 'Kelas persiapan UN mencakup latihan soal dan pembahasan materi-materi kunci.', 'type' => 'link', 'url' => 'https://classroom.google.com/c/OTk5MDAw'],
    ];

    protected static int $classIndex = 0;

    public function definition(): array
    {
        $index = self::$classIndex % count(self::$virtualClasses);
        $virtualClass = self::$virtualClasses[$index];
        self::$classIndex++;

        return [
            'grade' => $virtualClass['grade'],
            'class_name' => $virtualClass['class_name'],
            'title' => $virtualClass['title'],
            'description' => $virtualClass['description'],
            'type' => $virtualClass['type'],
            'url' => $virtualClass['url'],
            'file_path' => null,
            'embed_code' => null,
            'order' => $index + 1,
            'created_by' => User::factory(),
            'is_published' => true,
        ];
    }

    public static function resetIndex(): void
    {
        self::$classIndex = 0;
    }
}
