<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = $this->faker->name;

        return [
            'description' => $this->faker->sentence,
            'image' => $this->faker->imageUrl,
            'name' => $name,
            'slug' => str::slug($name),
            'parent_id' => 1,
            // Category::inRandomOrder()->first()->id,
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
