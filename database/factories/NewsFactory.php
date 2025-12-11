<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NewsCategory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    protected static array $newsTemplates = [
        'agenda' => [
            ['title' => 'Pelaksanaan Ujian Tengah Semester Ganjil Tahun Ajaran 2024/2025', 'excerpt' => 'Ujian Tengah Semester Ganjil akan dilaksanakan pada tanggal 14-18 Oktober 2024. Siswa diharapkan mempersiapkan diri dengan baik.'],
            ['title' => 'Kegiatan Class Meeting dan Pentas Seni Akhir Semester', 'excerpt' => 'Rangkaian kegiatan class meeting akan diisi dengan berbagai lomba dan ditutup dengan pentas seni siswa.'],
            ['title' => 'Pelaksanaan Study Tour Kelas 8 ke Yogyakarta', 'excerpt' => 'Study tour edukatif ke Yogyakarta meliputi kunjungan ke Candi Borobudur, Keraton, dan sentra batik.'],
            ['title' => 'Jadwal Libur Semester dan Pembagian Rapor', 'excerpt' => 'Penerimaan rapor semester ganjil akan dilaksanakan pada 20 Desember 2024.'],
            ['title' => 'Kegiatan MPLS untuk Siswa Baru Tahun Ajaran 2024/2025', 'excerpt' => 'Masa Pengenalan Lingkungan Sekolah akan dilaksanakan selama 3 hari untuk menyambut siswa baru.'],
        ],
        'pengumuman' => [
            ['title' => 'Pengumuman Hasil Seleksi PPDB Jalur Zonasi', 'excerpt' => 'Hasil seleksi PPDB jalur zonasi telah diumumkan. Calon siswa dapat mengecek status pendaftaran melalui website resmi.'],
            ['title' => 'Perubahan Jadwal Pembelajaran Masa Transisi Kurikulum Merdeka', 'excerpt' => 'Terdapat penyesuaian jadwal pembelajaran menyusul implementasi Kurikulum Merdeka di semester genap.'],
            ['title' => 'Pengumuman Pemenang Lomba Kebersihan Antar Kelas', 'excerpt' => 'Selamat kepada kelas 8B yang berhasil meraih juara 1 lomba kebersihan bulan ini.'],
            ['title' => 'Informasi Seragam dan Atribut Tahun Ajaran Baru', 'excerpt' => 'Pembelian seragam dan atribut sekolah dapat dilakukan di koperasi sekolah mulai 1 Juli 2024.'],
            ['title' => 'Himbauan Protokol Kesehatan di Lingkungan Sekolah', 'excerpt' => 'Sekolah tetap menerapkan protokol kesehatan untuk menjaga keamanan warga sekolah.'],
        ],
        'ppdb' => [
            ['title' => 'Pembukaan Pendaftaran Peserta Didik Baru Tahun Ajaran 2025/2026', 'excerpt' => 'PPDB SMPN 1 Nusantara resmi dibuka. Pendaftaran dapat dilakukan secara online melalui portal PPDB Jakarta.'],
            ['title' => 'Persyaratan dan Tata Cara Pendaftaran PPDB 2025', 'excerpt' => 'Simak informasi lengkap mengenai persyaratan, jadwal, dan tata cara pendaftaran PPDB.'],
            ['title' => 'Sosialisasi PPDB untuk Calon Wali Murid', 'excerpt' => 'Sekolah mengadakan sosialisasi PPDB untuk memberikan informasi lengkap kepada calon wali murid.'],
            ['title' => 'Jadwal Pengumuman Hasil Seleksi PPDB', 'excerpt' => 'Hasil seleksi PPDB akan diumumkan secara bertahap sesuai dengan jalur pendaftaran.'],
            ['title' => 'Daftar Ulang Peserta Didik Baru yang Diterima', 'excerpt' => 'Calon siswa yang dinyatakan diterima wajib melakukan daftar ulang sesuai jadwal yang ditentukan.'],
        ],
        'info' => [
            ['title' => 'SMPN 1 Nusantara Raih Predikat Sekolah Adiwiyata Mandiri', 'excerpt' => 'Prestasi membanggakan diraih sekolah dengan meraih predikat Sekolah Adiwiyata Mandiri dari Kementerian Lingkungan Hidup.'],
            ['title' => 'Siswa SMPN 1 Nusantara Wakili DKI Jakarta di OSN Tingkat Nasional', 'excerpt' => 'Dua siswa terbaik berhasil lolos seleksi dan akan mewakili provinsi di ajang OSN tingkat nasional.'],
            ['title' => 'Kerjasama dengan British Council untuk Program English Enhancement', 'excerpt' => 'Sekolah menjalin kerjasama dengan British Council untuk meningkatkan kemampuan bahasa Inggris siswa.'],
            ['title' => 'Renovasi Laboratorium IPA Selesai, Siap Digunakan', 'excerpt' => 'Laboratorium IPA yang baru direnovasi kini dilengkapi peralatan modern untuk mendukung pembelajaran sains.'],
            ['title' => 'Launching Website Resmi SMPN 1 Nusantara Versi Terbaru', 'excerpt' => 'Website resmi sekolah tampil dengan wajah baru yang lebih informatif dan user-friendly.'],
        ],
    ];

    public function definition(): array
    {
        $category = $this->faker->randomElement(['agenda', 'pengumuman', 'ppdb', 'info']);
        $newsItem = $this->faker->randomElement(self::$newsTemplates[$category]);
        $imageId = $this->faker->numberBetween(100, 999);

        $content = '<p>' . $newsItem['excerpt'] . '</p>';
        $content .= '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.</p>';
        $content .= '<p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>';
        $content .= '<p>Untuk informasi lebih lanjut, silakan hubungi pihak sekolah melalui kontak yang tersedia atau kunjungi langsung ke sekolah pada jam kerja.</p>';

        return [
            'category_id' => NewsCategory::factory(),
            'title' => $newsItem['title'],
            'excerpt' => $newsItem['excerpt'],
            'content' => $content,
            'featured_image' => 'https://fastly.picsum.photos/id/' . $imageId . '/800/450',
            'publish_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => 'published',
            'author_id' => User::factory(),
            'views' => $this->faker->numberBetween(50, 2000),
            'is_featured' => $this->faker->boolean(20),
            'is_pinned' => $this->faker->boolean(10),
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => null,
        ];
    }
}
