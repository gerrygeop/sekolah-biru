<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Achievement>
 */
class AchievementFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'category' => $this->faker->randomElement(['akademik', 'olahraga', 'seni', 'lainnya']),
            'level' => $this->faker->randomElement(['sekolah', 'kecamatan', 'kabupaten', 'provinsi', 'nasional', 'internasional']),
            'achievement_rank' => 'Juara ' . $this->faker->numberBetween(1, 3),
            'student_name' => $this->faker->name,
            'student_class' => $this->faker->randomElement(['7A', '8B', '9C']),
            'achievement_date' => $this->faker->date(),
            'image_path' => null,
            'created_by' => User::factory(),
            'is_published' => true,
        ];
    }
}
