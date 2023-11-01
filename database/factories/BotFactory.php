<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use App\Helpers\FakeUsername;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Bot>
 */
class BotFactory extends Factory
{
    public function definition(): array
    {
        return [
			'name'                 => Str::random(30),
			'token'                => Str::random(45),
			'telegram_id'          => fake()->randomNumber(7, true),
			'offset'               => fake()->randomNumber(7, true),
			'username'             => FakeUsername::generate(),
			'description'          => Str::random(250),
			'short_description'    => Str::random(100),
			'updates_retrieved_at' => fake()->dateTime()
        ];
    }
}