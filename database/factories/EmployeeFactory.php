<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    protected static array $maleNames = [
        'Ahmad Fauzi', 'Budi Santoso', 'Cahyo Wibowo', 'Dedi Kurniawan', 'Eko Prasetyo',
        'Fajar Nugroho', 'Gunawan Hidayat', 'Hendra Wijaya', 'Irwan Susanto', 'Joko Widodo',
        'Kusuma Adi', 'Lukman Hakim', 'Muhammad Rizky', 'Nur Hidayat', 'Oscar Pratama',
        'Purnomo Sidi', 'Rudi Hartono', 'Sugeng Priyanto', 'Teguh Prasetya', 'Umar Faruq',
    ];

    protected static array $femaleNames = [
        'Ani Suryani', 'Beti Kristiani', 'Citra Dewi', 'Dian Puspitasari', 'Eka Rahmawati',
        'Fitri Handayani', 'Gita Nuraini', 'Hesti Wulandari', 'Indah Permatasari', 'Julia Sari',
        'Kartika Sari', 'Lestari Utami', 'Maria Kristina', 'Novi Andriani', 'Putri Ayu',
        'Ratna Sari', 'Sri Wahyuni', 'Tuti Alawiyah', 'Umi Kulsum', 'Wati Sulistyowati',
    ];

    protected static array $teacherSubjects = [
        'Matematika', 'Bahasa Indonesia', 'Bahasa Inggris', 'IPA (Fisika)',
        'IPA (Biologi)', 'IPS (Sejarah)', 'IPS (Geografi)', 'PKn',
        'Pendidikan Agama Islam', 'Pendidikan Agama Kristen', 'Seni Budaya',
        'PJOK', 'Prakarya', 'TIK', 'Bahasa Jawa', 'BK',
    ];

    protected static array $teacherPositions = [
        'Guru Mata Pelajaran',
        'Guru Mata Pelajaran',
        'Guru Mata Pelajaran',
        'Guru Mata Pelajaran',
        'Wali Kelas',
        'Wali Kelas',
        'Koordinator Mata Pelajaran',
        'Pembina OSIS',
        'Pembina Ekstrakurikuler',
    ];

    protected static array $staffPositions = [
        'Kepala Tata Usaha',
        'Staff Administrasi',
        'Staff Keuangan',
        'Operator Dapodik',
        'Pustakawan',
        'Laboran',
        'Petugas Kebersihan',
        'Satpam',
        'Penjaga Sekolah',
    ];

    public function definition(): array
    {
        $gender = $this->faker->randomElement(['male', 'female']);
        $name = $gender === 'male' 
            ? $this->faker->randomElement(self::$maleNames)
            : $this->faker->randomElement(self::$femaleNames);
        
        $type = $this->faker->randomElement(['guru', 'guru', 'guru', 'staff', 'tenaga_kependidikan']);
        
        $position = match ($type) {
            'guru' => $this->faker->randomElement(self::$teacherPositions),
            default => $this->faker->randomElement(self::$staffPositions),
        };

        $subject = $type === 'guru' ? $this->faker->randomElement(self::$teacherSubjects) : null;

        // Generate NIP format: YYYYMMDD YYYYMM X XXX (18 digits)
        $birthYear = $this->faker->numberBetween(1970, 1995);
        $birthMonth = str_pad($this->faker->numberBetween(1, 12), 2, '0', STR_PAD_LEFT);
        $birthDay = str_pad($this->faker->numberBetween(1, 28), 2, '0', STR_PAD_LEFT);
        $appointmentYear = $this->faker->numberBetween($birthYear + 22, 2020);
        $appointmentMonth = str_pad($this->faker->numberBetween(1, 12), 2, '0', STR_PAD_LEFT);
        $genderCode = $gender === 'male' ? '1' : '2';
        $sequence = str_pad($this->faker->numberBetween(1, 999), 3, '0', STR_PAD_LEFT);
        
        $nip = "{$birthYear}{$birthMonth}{$birthDay} {$appointmentYear}{$appointmentMonth} {$genderCode} {$sequence}";

        $photoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&size=200&background=random&color=fff';

        return [
            'nip' => str_replace(' ', '', $nip),
            'name' => $name,
            'type' => $type,
            'position' => $position,
            'subject' => $subject,
            'education' => $this->faker->randomElement(['S1', 'S1', 'S1', 'S2', 'D3']),
            'phone' => '+62' . $this->faker->numerify('8#########'),
            'email' => strtolower(str_replace(' ', '.', $name)) . '@smpn1nusantara.sch.id',
            'photo_path' => $photoUrl,
            'join_date' => $this->faker->dateTimeBetween('-15 years', '-1 year'),
            'is_active' => true,
        ];
    }

    public function teacher(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'guru',
            'position' => $this->faker->randomElement(self::$teacherPositions),
            'subject' => $this->faker->randomElement(self::$teacherSubjects),
        ]);
    }

    public function staff(): static
    {
        return $this->state(fn (array $attributes) => [
            'type' => 'staff',
            'position' => $this->faker->randomElement(self::$staffPositions),
            'subject' => null,
        ]);
    }
}
