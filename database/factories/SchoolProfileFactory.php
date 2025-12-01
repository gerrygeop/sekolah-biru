<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SchoolProfile>
 */
class SchoolProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            'school_name' => 'SMP Negeri ' . $this->faker->numberBetween(1, 10) . ' ' . $this->faker->city,
            'npsn' => $this->faker->unique()->numerify('########'),
            'vision' => $this->faker->paragraph,
            'mission' => $this->faker->paragraphs(3, true),
            'about' => $this->faker->paragraphs(2, true),
            'address' => $this->faker->address,
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->companyEmail,
            'whatsapp' => $this->faker->phoneNumber,
            'logo_path' => null,
        ];
    }
}
