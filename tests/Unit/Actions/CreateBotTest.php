<?php

namespace Tests\Unit\Actions;

use Exception;
use Mockery as m;
use App\Models\Bot;
use Tests\TestCase;
use Telegram\Bot\Api;
use App\Actions\CreateBot;
use Mockery\MockInterface;
use App\Data\CreateBotData;
use App\Http\Resources\BotResource;
use Illuminate\Validation\ValidationException;
use Telegram\Bot\Objects\User as TelegramUser;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateBotTest extends TestCase
{
	use RefreshDatabase;

	protected function tearDown(): void
	{
		parent::tearDown();
		m::close();
	}

	/** @test */
	public function it_creates_a_bot_with_valid_token()
	{
		$botData = new CreateBotData(
			token: 'token'
		);

		$telegramUser = new TelegramUser([
			'id'         => 12345,
			'first_name' => 'BotName',
			'username'   => 'username_bot',
		]);

		$this->partialMock(
			Api::class, function (MockInterface $mock) use ($telegramUser) {
				$mock->shouldReceive('getMe')->andReturn($telegramUser);
			}
		);

		$result = app(CreateBot::class)($botData);

		$this->assertInstanceOf(BotResource::class, $result);
	}

	/** @test */
	public function it_throws_validation_exception_for_invalid_token()
	{
		$botData = new CreateBotData(
			token: 'token'
		);

		$this->partialMock(
			Api::class, function (MockInterface $mock) {
				$mock->shouldReceive('getMe')->andThrow(new Exception(json_encode([
					'ok'          => false,
					'error_code'  => 401,
					'description' => 'Unauthorized'
				]), 401));
			}
		);

		$this->expectException(ValidationException::class);

		app(CreateBot::class)($botData);
	}

	/** @test */
	public function it_throws_validation_exception_if_bot_already_exists()
	{
		$botData = new CreateBotData(
			token: 'token'
		);

		$telegramUser = new TelegramUser([
			'id'         => 12345,
			'first_name' => 'BotName',
			'username'   => 'username_bot',
		]);

		$this->partialMock(
			Api::class, function (MockInterface $mock) use ($telegramUser) {
				$mock->shouldReceive('getMe')->andReturn($telegramUser);
			}
		);

		Bot::create([
			'telegram_id' => 12345,
			'name'        => 'BotName',
			'username'    => 'username_bot',
			'token'       => 'token',
		]);

		$this->expectException(ValidationException::class);

		app(CreateBot::class)($botData);
	}
}
