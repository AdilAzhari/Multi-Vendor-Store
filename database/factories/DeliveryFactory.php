<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id' => 1,
            'lat' => $this->faker->latitude,
            'lng' => $this->faker->longitude,
            'tracking_number' => $this->faker->word,
            'carrier' => $this->faker->word,
            'status' => $this->faker->randomElement(['pending', 'shipped', 'delivered']),
            'shipped_at' => $this->faker->dateTime,
            'delivered_at' => $this->faker->dateTime,
            'notes' => $this->faker->text,
            'tracking_url' => $this->faker->url,
            'tracking_url_provider' => $this->faker->url,
        ];
    }
}
