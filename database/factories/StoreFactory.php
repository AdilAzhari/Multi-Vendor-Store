<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\store>
 */
class StoreFactory extends Factory
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
            'logo_image' => $this->faker->imageUrl,
            'cover_image' => $this->faker->imageUrl,
            'status' => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}
