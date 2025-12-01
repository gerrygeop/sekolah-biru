<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VirtualClass>
 */
class VirtualClassFactory extends Factory
{
    public function definition(): array
    {
        return [
            'grade' => $this->faker->randomElement(['7', '8', '9']),
            'class_name' => $this->faker->randomElement(['7A', '7B', '8A', '8B', '9A', '9B']),
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'type' => $this->faker->randomElement(['link', 'file', 'embed']),
            'url' => $this->faker->url,
            'file_path' => null,
            'embed_code' => null,
            'order' => $this->faker->numberBetween(1, 100),
            'created_by' => User::factory(),
            'is_published' => true,
        ];
    }
}
