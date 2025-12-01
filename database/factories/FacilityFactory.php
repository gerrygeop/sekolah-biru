<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Facility>
 */
class FacilityFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'description' => $this->faker->paragraph,
            'quantity' => $this->faker->numberBetween(1, 50),
            'condition' => $this->faker->randomElement(['baik', 'rusak_ringan', 'rusak_berat']),
            'order' => $this->faker->numberBetween(1, 100),
            'is_published' => true,
        ];
    }
}
