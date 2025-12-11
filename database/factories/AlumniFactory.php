<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumni>
 */
class AlumniFactory extends Factory
{
    protected static array $maleNames = [
        'Ahmad Rizky Pratama', 'Budi Setiawan', 'Cahyo Wibowo', 'Dedi Kurniawan',
        'Eko Prasetyo', 'Fajar Nugroho', 'Galih Permana', 'Hendra Wijaya',
        'Irfan Hakim', 'Jaka Tingkir', 'Kevin Sanjaya', 'Lukman Syahputra',
        'Muhammad Farhan', 'Naufal Ghifari', 'Oscar Pratama', 'Pandu Wibisono',
    ];

    protected static array $femaleNames = [
        'Anisa Rahma', 'Bella Safitri', 'Citra Dewi', 'Dian Puspita',
        'Eka Rahmawati', 'Fitri Handayani', 'Gita Nuraini', 'Hesti Wulandari',
        'Indah Cahyani', 'Julia Sari', 'Kartika Putri', 'Laras Sekar',
        'Maya Angelina', 'Nadia Permata', 'Olivia Susanti', 'Putri Ayu',
    ];

    protected static array $smaNames = [
        'SMAN 1 Jakarta', 'SMAN 3 Jakarta', 'SMAN 8 Jakarta', 'SMAN 28 Jakarta',
        'SMAN 68 Jakarta', 'SMAN 70 Jakarta', 'SMA Labschool Jakarta', 'SMA Santa Ursula',
        'SMA Kanisius', 'SMA Gonzaga', 'SMA Al-Azhar', 'SMAK BPK Penabur',
    ];

    protected static array $testimonials = [
        'Belajar di SMP Negeri 1 Nusantara membentuk karakter dan disiplin saya. Guru-guru yang luar biasa dan fasilitas yang lengkap membuat saya siap menghadapi jenjang pendidikan berikutnya.',
        'Tiga tahun di SMPN 1 Nusantara adalah pengalaman tak terlupakan. Saya banyak belajar tidak hanya akademik tapi juga soft skill melalui berbagai kegiatan ekstrakurikuler.',
        'Terima kasih SMPN 1 Nusantara yang telah memberikan fondasi pendidikan terbaik. Prestasi yang saya raih saat SMP menjadi bekal berharga untuk pendidikan selanjutnya.',
        'SMPN 1 Nusantara mengajarkan saya arti persahabatan dan kerja keras. Para guru yang berdedikasi tinggi selalu memotivasi kami untuk meraih prestasi terbaik.',
        'Fasilitas laboratorium dan perpustakaan yang lengkap sangat membantu pengembangan minat saya di bidang sains. Bangga menjadi alumni SMPN 1 Nusantara!',
        'Kegiatan OSIS dan ekstrakurikuler di SMPN 1 Nusantara membentuk jiwa kepemimpinan saya. Kini pengalaman tersebut sangat berguna dalam organisasi di SMA.',
        'Lingkungan belajar yang kondusif dan teman-teman yang supportive membuat masa SMP saya menyenangkan. Terima kasih SMPN 1 Nusantara!',
        'Metode pembelajaran yang inovatif di SMPN 1 Nusantara membuat saya menyukai proses belajar. Sekarang saya lebih percaya diri dalam menghadapi tantangan.',
    ];

    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $name = $gender === 'male' 
            ? $this->faker->randomElement(self::$maleNames)
            : $this->faker->randomElement(self::$femaleNames);

        $graduationYear = $this->faker->numberBetween(2019, 2024);
        
        $photoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&size=200&background=random&color=fff';

        return [
            'name' => $name,
            'nisn' => $this->faker->unique()->numerify('00########'),
            'graduation_year' => $graduationYear,
            'current_school' => $this->faker->randomElement(self::$smaNames),
            'current_occupation' => null,
            'phone' => '+62' . $this->faker->numerify('8#########'),
            'email' => strtolower(str_replace(' ', '.', $name)) . '@gmail.com',
            'testimonial' => $this->faker->randomElement(self::$testimonials),
            'photo_path' => $photoUrl,
            'is_featured' => $this->faker->boolean(25),
        ];
    }
}
