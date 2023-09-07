<?php

namespace Database\Factories;

use App\Enums\TravelAgencyStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class TravelAgencyFactory extends Factory
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
            'prefecture' => fake()->name(),
            'locality' => fake()->name(),
            'address_lines' => fake()->name(),
            'bank_name' => fake()->name(),
            'bank_branch' => fake()->name(),
            'bank_account_name' => fake()->name(),
            'approval_status' => TravelAgencyStatus::APPROVED->value
        ];
    }
}
