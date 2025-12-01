<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\NewsCategory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\News>
 */
class NewsFactory extends Factory
{
    public function definition(): array
    {
        return [
            'category_id' => NewsCategory::factory(),
            'title' => $this->faker->sentence,
            'excerpt' => $this->faker->paragraph,
            'content' => $this->faker->paragraphs(3, true),
            'featured_image' => null,
            'publish_date' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => 'published',
            'author_id' => User::factory(),
            'views' => $this->faker->numberBetween(0, 1000),
            'is_featured' => $this->faker->boolean(20),
            'is_pinned' => $this->faker->boolean(10),
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => null,
        ];
    }
}
