<?php

namespace Database\Factories;

use App\Enums\UserRole;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'username'       => fake()->name(),
			'role'			 => UserRole::USER,
            'password'       => Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }
}
