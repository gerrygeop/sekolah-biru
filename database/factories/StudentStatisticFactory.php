<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\AcademicYear;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudentStatistic>
 */
class StudentStatisticFactory extends Factory
{
    public function definition(): array
    {
        return [
            'academic_year_id' => AcademicYear::factory(),
            'grade' => $this->faker->randomElement(['7', '8', '9']),
            'male_count' => $this->faker->numberBetween(50, 150),
            'female_count' => $this->faker->numberBetween(50, 150),
            'total_classes' => $this->faker->numberBetween(3, 8),
        ];
    }
}
