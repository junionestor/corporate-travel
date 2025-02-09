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
            'order_status_id' => 1,
            'name' => $this->faker->name,
            'destination' => $this->faker->city,
            'start_date' => $date,
            'end_date' => $date->addDays(5),
        ];
    }
}
