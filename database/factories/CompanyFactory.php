<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class CompanyFactory extends Factory
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
            'prefecture' => fake()->name(),
            'locality' => fake()->name(),
            'address_lines' => fake()->name(),
            'manager_id' => 2,
            'approval_status' => rand(1, 2),
            'approved_by_id' => 1,
        ];
    }
}
