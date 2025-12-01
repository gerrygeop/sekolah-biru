<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AcademicYear>
 */
class AcademicYearFactory extends Factory
{
    public function definition(): array
    {
        $year = $this->faker->year;
        return [
            'year' => $year . '/' . ($year + 1),
            'start_date' => $year . '-07-01',
            'end_date' => ($year + 1) . '-06-30',
            'is_active' => false,
        ];
    }
}
