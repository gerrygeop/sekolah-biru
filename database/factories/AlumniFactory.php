<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Alumni>
 */
class AlumniFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'nisn' => $this->faker->unique()->numerify('##########'),
            'graduation_year' => $this->faker->year,
            'current_school' => 'SMA ' . $this->faker->city,
            'current_occupation' => null,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'testimonial' => $this->faker->paragraph,
            'photo_path' => null,
            'is_featured' => $this->faker->boolean(20),
        ];
    }
}
