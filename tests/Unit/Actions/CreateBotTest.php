<?php

namespace Tests\Unit\Actions;

use stdClass;
use Mockery as m;
use App\Models\Bot;
use Tests\TestCase;
use App\Enums\BotStatus;
use App\Actions\CreateBot;
use Mockery\MockInterface;
use App\Data\CreateBotData;
use App\Http\Resources\BotResource;
use App\Services\Telegram\TelegramApi;
use App\Services\Telegram\Types\TelegramUser;
use Illuminate\Validation\ValidationException;
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

		$userAttributes = new stdClass();
		$userAttributes->id         = 12345;
		$userAttributes->is_bot     = true;
		$userAttributes->first_name = 'BotName';
		$userAttributes->username   = 'username_bot';

		$telegramUser = new TelegramUser($userAttributes);

		$this->partialMock(
			TelegramApi::class, function (MockInterface $mock) use ($telegramUser) {
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
			TelegramApi::class, function (MockInterface $mock) {
				$mock->shouldReceive('getMe')->andReturn(null);
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

		$userAttributes = new stdClass();
		$userAttributes->id         = 12345;
		$userAttributes->is_bot     = true;
		$userAttributes->first_name = 'BotName';
		$userAttributes->username   = 'username_bot';

		$telegramUser = new TelegramUser($userAttributes);

		$this->partialMock(
			TelegramApi::class, function (MockInterface $mock) use ($telegramUser) {
				$mock->shouldReceive('getMe')->andReturn($telegramUser);
			}
		);

		Bot::create([
			'telegram_id' => 12345,
			'name'        => 'BotName',
			'username'    => 'username_bot',
			'token'       => 'token',
			'status'	  => BotStatus::ACTIVE,
		]);

		$this->expectException(ValidationException::class);

		app(CreateBot::class)($botData);
	}
}
