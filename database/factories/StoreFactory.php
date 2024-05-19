<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->sentence,
            'logo_image' => $this->faker->imageUrl,
            'cover_image' => $this->faker->imageUrl,
            'slug'=> $this->faker->slug,
            'status' => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}
