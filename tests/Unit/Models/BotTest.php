<?php

namespace Tests\Unit\Models;

use Carbon\Carbon;
use App\Models\Bot;
use Tests\TestCase;
use App\Helpers\FakeUsername;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BotTest extends TestCase
{
	use RefreshDatabase;

	/** @test */
	public function it_has_bots_table()
	{
		$this->assertTrue(Schema::hasTable('bots'));
	}

	/** @test */
	public function it_has_expected_columns_in_bots_table()
	{
		$expectedColumns = [
			'id',
			'telegram_id',
			'name',
			'username',
			'description',
			'short_description',
			'token',
			'offset',
			'updates_retrieved_at',
			'created_at',
			'updated_at',
		];

		$tableColumns = Schema::getColumnListing('bots');

		$this->assertEquals($expectedColumns, $tableColumns);
	}

	/** @test */
	public function it_can_create_a_bot()
	{
		$botData = [
			'name'                 => 'Test Bot',
			'token'                => 'test-token',
			'offset'               => 100,
			'username'             => FakeUsername::generate(),
			'telegram_id'		   => 1234123,
			'description'          => 'Test bot description',
			'short_description'    => 'Test bot short description',
			'updates_retrieved_at' => Carbon::now(),
		];

		$bot = Bot::create($botData);

		$this->assertInstanceOf(Bot::class, $bot);
		$this->assertEquals($botData['name'], $bot->name);
		$this->assertEquals($botData['token'], $bot->token);
		$this->assertEquals($botData['offset'], $bot->offset);
		$this->assertEquals($botData['username'], $bot->username);
		$this->assertEquals($botData['telegram_id'], $bot->telegram_id);
		$this->assertEquals($botData['description'], $bot->description);
		$this->assertEquals($botData['short_description'], $bot->short_description);
		$this->assertNotEmpty($bot->updates_retrieved_at);
	}
}
