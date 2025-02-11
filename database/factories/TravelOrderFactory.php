<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TravelOrder>
 */
class TravelOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $date = now();

        return [
            'travel_order_id' => $this->faker->uuid,
            'name' => $this->faker->name,
            'destination' => $this->faker->city,
            'start_date' => $date->toDateString(),
            'end_date' => $date->addDays(5)->toDateString(),
            'order_status_id' => 1,
        ];
    }
}
