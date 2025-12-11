<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    protected static array $facilities = [
        [
            'name' => 'Ruang Kelas',
            'description' => 'Ruang kelas ber-AC dengan kapasitas 32 siswa, dilengkapi LCD proyektor, papan tulis whiteboard, dan meja kursi ergonomis untuk mendukung kegiatan belajar mengajar yang nyaman.',
            'quantity' => 24,
            'condition' => 'baik',
            'order' => 1,
        ],
        [
            'name' => 'Laboratorium IPA',
            'description' => 'Laboratorium IPA lengkap dengan peralatan praktikum Fisika, Biologi, dan Kimia. Dilengkapi meja praktikum, lemari penyimpanan alat, dan sistem ventilasi yang baik.',
            'quantity' => 2,
            'condition' => 'baik',
            'order' => 2,
        ],
        [
            'name' => 'Laboratorium Komputer',
            'description' => 'Laboratorium komputer dengan 40 unit PC modern, akses internet berkecepatan tinggi, AC, dan software pembelajaran terkini untuk mendukung pembelajaran TIK.',
            'quantity' => 2,
            'condition' => 'baik',
            'order' => 3,
        ],
        [
            'name' => 'Laboratorium Bahasa',
            'description' => 'Laboratorium bahasa multimedia dengan headset dan booth individual untuk pembelajaran Bahasa Indonesia dan Bahasa Inggris yang interaktif.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 4,
        ],
        [
            'name' => 'Perpustakaan',
            'description' => 'Perpustakaan dengan koleksi lebih dari 10.000 buku, ruang baca nyaman, area diskusi, dan sistem katalog digital untuk memudahkan pencarian referensi.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 5,
        ],
        [
            'name' => 'Aula Serbaguna',
            'description' => 'Aula serbaguna berkapasitas 500 orang dengan sound system profesional, AC sentral, dan panggung untuk berbagai kegiatan sekolah dan acara besar.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 6,
        ],
        [
            'name' => 'Lapangan Olahraga',
            'description' => 'Lapangan olahraga outdoor yang mencakup lapangan basket, voli, futsal, dan lintasan atletik untuk mendukung kegiatan PJOK dan ekstrakurikuler olahraga.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 7,
        ],
        [
            'name' => 'Mushola',
            'description' => 'Mushola dengan kapasitas 200 jamaah, dilengkapi tempat wudhu terpisah putra-putri, area sholat ber-AC, dan perlengkapan ibadah lengkap.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 8,
        ],
        [
            'name' => 'Ruang UKS',
            'description' => 'Unit Kesehatan Sekolah dengan peralatan P3K lengkap, tempat tidur pasien, dan tenaga medis terlatih untuk menangani kebutuhan kesehatan siswa.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 9,
        ],
        [
            'name' => 'Kantin Sekolah',
            'description' => 'Kantin sekolah yang bersih dan nyaman dengan menu makanan sehat dan bergizi. Dikelola dengan standar higienitas tinggi dan pengawasan rutin.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 10,
        ],
        [
            'name' => 'Ruang Guru',
            'description' => 'Ruang guru ber-AC dengan fasilitas meja kerja individual, komputer, printer, dan area rapat untuk koordinasi dan persiapan mengajar.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 11,
        ],
        [
            'name' => 'Ruang BK',
            'description' => 'Ruang Bimbingan dan Konseling yang nyaman dan privat untuk konsultasi siswa, dilengkapi dengan ruang individu dan kelompok.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 12,
        ],
        [
            'name' => 'Ruang OSIS',
            'description' => 'Ruang sekretariat OSIS untuk kegiatan organisasi kesiswaan, dilengkapi dengan meja rapat, papan kegiatan, dan perlengkapan administrasi.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 13,
        ],
        [
            'name' => 'Toilet',
            'description' => 'Toilet bersih dengan air mengalir lancar, terpisah untuk putra dan putri, dilengkapi wastafel dan hand dryer.',
            'quantity' => 20,
            'condition' => 'baik',
            'order' => 14,
        ],
        [
            'name' => 'Area Parkir',
            'description' => 'Area parkir luas dan teduh untuk kendaraan guru, staff, dan tamu sekolah dengan sistem keamanan 24 jam.',
            'quantity' => 1,
            'condition' => 'baik',
            'order' => 15,
        ],
    ];

    protected static int $facilityIndex = 0;

    public function definition(): array
    {
        // If we've used all predefined facilities, use the last one or create generic
        $index = self::$facilityIndex % count(self::$facilities);
        $facility = self::$facilities[$index];
        self::$facilityIndex++;

        return [
            'name' => $facility['name'],
            'description' => $facility['description'],
            'quantity' => $facility['quantity'],
            'condition' => $facility['condition'],
            'order' => $facility['order'],
            'is_published' => true,
        ];
    }

    public static function resetIndex(): void
    {
        self::$facilityIndex = 0;
    }
}
