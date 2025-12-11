<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationStructure>
 */
class OrganizationStructureFactory extends Factory
{
    protected static array $positions = [
        ['position' => 'Kepala Sekolah', 'order' => 1],
        ['position' => 'Wakil Kepala Sekolah Bidang Kurikulum', 'order' => 2],
        ['position' => 'Wakil Kepala Sekolah Bidang Kesiswaan', 'order' => 3],
        ['position' => 'Wakil Kepala Sekolah Bidang Sarana Prasarana', 'order' => 4],
        ['position' => 'Wakil Kepala Sekolah Bidang Humas', 'order' => 5],
        ['position' => 'Kepala Tata Usaha', 'order' => 6],
        ['position' => 'Koordinator BK', 'order' => 7],
        ['position' => 'Kepala Perpustakaan', 'order' => 8],
        ['position' => 'Kepala Laboratorium IPA', 'order' => 9],
        ['position' => 'Kepala Laboratorium Komputer', 'order' => 10],
    ];

    protected static array $names = [
        'Dr. H. Bambang Suryadi, M.Pd.',
        'Drs. Ahmad Fauzi, M.M.',
        'Hj. Sri Wahyuni, S.Pd., M.Pd.',
        'Drs. Sugeng Priyanto',
        'Ir. Hendra Wijaya, M.T.',
        'Dra. Ratna Sari, M.Si.',
        'Dra. Indah Permatasari',
        'Siti Rahayu, S.Pd.',
        'Drs. Eko Prasetyo, M.Pd.',
        'Budi Santoso, S.Kom.',
    ];

    protected static int $positionIndex = 0;

    public function definition(): array
    {
        $index = self::$positionIndex % count(self::$positions);
        $positionData = self::$positions[$index];
        $name = self::$names[$index] ?? $this->faker->name;
        self::$positionIndex++;

        // Generate NIP
        $birthYear = $this->faker->numberBetween(1965, 1980);
        $birthMonth = str_pad($this->faker->numberBetween(1, 12), 2, '0', STR_PAD_LEFT);
        $birthDay = str_pad($this->faker->numberBetween(1, 28), 2, '0', STR_PAD_LEFT);
        $appointmentYear = $this->faker->numberBetween($birthYear + 22, 2010);
        $appointmentMonth = str_pad($this->faker->numberBetween(1, 12), 2, '0', STR_PAD_LEFT);
        $genderCode = $this->faker->randomElement(['1', '2']);
        $sequence = str_pad($this->faker->numberBetween(1, 999), 3, '0', STR_PAD_LEFT);
        
        $nip = "{$birthYear}{$birthMonth}{$birthDay}{$appointmentYear}{$appointmentMonth}{$genderCode}{$sequence}";

        $photoUrl = 'https://ui-avatars.com/api/?name=' . urlencode($name) . '&size=200&background=0D6EFD&color=fff';

        return [
            'position' => $positionData['position'],
            'name' => $name,
            'nip' => $nip,
            'photo_path' => $photoUrl,
            'order' => $positionData['order'],
            'is_active' => true,
        ];
    }

    public static function resetIndex(): void
    {
        self::$positionIndex = 0;
    }
}
