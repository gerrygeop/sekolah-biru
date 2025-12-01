<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrganizationStructure>
 */
class OrganizationStructureFactory extends Factory
{
    public function definition(): array
    {
        return [
            'position' => $this->faker->jobTitle,
            'name' => $this->faker->name,
            'nip' => $this->faker->unique()->numerify('##################'),
            'photo_path' => null,
            'order' => $this->faker->numberBetween(1, 100),
            'is_active' => true,
        ];
    }
}
