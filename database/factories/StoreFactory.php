<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class StoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => fake()->name(),
            'tel' => fake()->phoneNumber(),
            'fax' => fake()->tollFreePhoneNumber(),
            'post_code' => fake()->postcode(),
            'address_lines' => fake()->name(),
            'max_people' => 5,
            'smoking_policy' => rand(1, 2),
            'parking' => rand(1, 2),
            'cp' => rand(1, 2),
            'prefecture_id' => 1,
            'parking_remarks' => 'parking_remarks',
            'boarding_place' => 1,
            'lat' => 1,
            'long' => 1,
        ];
    }
}
