<?php

namespace Database\Factories;

use App\Enums\ChatType;
use App\Enums\ChatStatus;
use Illuminate\Support\Str;
use App\Helpers\FakeUsername;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chat>
 */
class ChatFactory extends Factory
{
    public function definition(): array
    {
        return [
			'bio'              => Str::random(100),
			'type'             => fake()->randomElement(ChatType::cases()),
			'status'           => fake()->randomElement(ChatStatus::cases()),
			'username'         => FakeUsername::generate(),
			'last_name'        => fake()->lastName(),
			'first_name'       => fake()->firstName(),
			'telegram_chat_id' => fake()->randomNumber(7, true),
        ];
    }
}