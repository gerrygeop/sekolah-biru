<?php

namespace Database\Factories;

use App\Models\AlumniDistribution;
use App\Models\AcademicYear;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AlumniDistribution>
 */
class AlumniDistributionFactory extends Factory
{
    protected $model = AlumniDistribution::class;

    protected static array $smaNames = [
        'SMAN 1 Jakarta',
        'SMAN 3 Jakarta', 
        'SMAN 8 Jakarta',
        'SMAN 68 Jakarta',
        'SMAN 70 Jakarta',
        'SMA Labschool Jakarta',
        'SMA Santa Ursula',
        'SMA Kanisius',
        'SMA Gonzaga',
        'SMA Al-Azhar Kelapa Gading',
    ];

    protected static array $smkNames = [
        'SMKN 1 Jakarta',
        'SMKN 4 Jakarta',
        'SMKN 26 Jakarta',
        'SMKN 57 Jakarta',
        'SMK Telkom Jakarta',
        'SMK Wikrama Bogor',
    ];

    protected static array $maNames = [
        'MAN 1 Jakarta',
        'MAN 2 Jakarta',
        'MA Al-Azhar',
        'MA Darul Ulum',
    ];

    public function definition(): array
    {
        $schoolType = $this->faker->randomElement(['sma', 'smk', 'ma', 'lainnya']);
        
        $schoolName = match ($schoolType) {
            'sma' => $this->faker->randomElement(self::$smaNames),
            'smk' => $this->faker->randomElement(self::$smkNames),
            'ma' => $this->faker->randomElement(self::$maNames),
            default => 'Sekolah Lainnya',
        };

        return [
            'academic_year_id' => AcademicYear::factory(),
            'school_name' => $schoolName,
            'school_type' => $schoolType,
            'student_count' => $this->faker->numberBetween(5, 35),
        ];
    }
}
