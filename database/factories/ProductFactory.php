<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Store;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\product>
 */
class ProductFactory extends Factory
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
            'name' => $name,
            'slug' => str::slug($name),
            'description' => $this->faker->sentence,
            'store_id' => Store::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'image' => $this->faker->imageUrl,
            'price' => $this->faker->randomFloat(2, 1, 100),
            'compare_price' => $this->faker->randomFloat(2, 1, 100),
            // 'options' => $this->faker->sentence,
            'rating' => $this->faker->randomFloat(2, 1, 5),
            'featured' => rand(0,1),
            'status' => $this->faker->randomElement(['draft', 'published', 'archived']),
            // 'featured' => $this->faker->boolean(50),
        ];
    }
}
