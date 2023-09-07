<?php

namespace Database\Factories;

use App\Enums\AccountStatus;
use App\Enums\ApplicationStatus;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'email' => preg_replace('/@example\..*/', '@domain.com', fake()->unique()->safeEmail),
            'first_name' => fake()->name(),
            'last_name' => fake()->name(),
            'furigana_first_name' => '旅行会社名',
            'furigana_last_name' => '旅行会社名',
            'tel' => '000-111-222',
            'fax' => '000-111-222',
            'status' => AccountStatus::ACTIVATED->value
        ];
    }

    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::ADMIN->value,
            ];
        });
    }

    public function user()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::AGENCY->value,
            ];
        });
    }

    public function company()
    {
        return $this->state(function (array $attributes) {
            return [
                'role_id' => Role::COMPANY->value,
            ];
        });
    }
}
