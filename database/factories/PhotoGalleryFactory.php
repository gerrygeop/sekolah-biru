<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PhotoGallery>
 */
class PhotoGalleryFactory extends Factory
{
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph,
            'image_path' => $this->faker->imageUrl(),
            'thumbnail_path' => null,
            'photo_date' => $this->faker->date(),
            'created_by' => User::factory(),
            'order' => $this->faker->numberBetween(1, 100),
            'is_published' => true,
        ];
    }
}
