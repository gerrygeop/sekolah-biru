<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nip' => $this->faker->unique()->numerify('##################'),
            'name' => $this->faker->name,
            'type' => $this->faker->randomElement(['guru', 'staff', 'tenaga_kependidikan']),
            'position' => $this->faker->jobTitle,
            'subject' => $this->faker->optional()->word,
            'education' => $this->faker->randomElement(['S1', 'S2', 'S3', 'D3']),
            'phone' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'photo_path' => null,
            'join_date' => $this->faker->date(),
            'is_active' => true,
        ];
    }
}
