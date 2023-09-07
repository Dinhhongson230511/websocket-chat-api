<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'project_start_date' => fake()->dateTime(),
            'reservation_start_time' => fake()->dateTime(),
            'reservation_end_time' => fake()->dateTime(),
            'number_of_adults' => fake()->numberBetween(0, 100),
            'number_of_children' => fake()->numberBetween(0, 100),
            'number_of_infants' => fake()->numberBetween(0, 100),
            'number_of_guides' => fake()->numberBetween(0, 100),
            'number_of_dg' => fake()->numberBetween(0, 100),
            'name' => fake()->name()
        ];
    }
}
