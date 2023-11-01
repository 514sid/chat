<?php

namespace Tests\Unit\Models;

use App\Models\Bot;
use Tests\TestCase;
use App\Models\Chat;
use App\Models\User;
use App\Enums\ChatType;
use App\Enums\ChatStatus;
use App\Helpers\FakeUsername;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ChatTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_chats_table()
    {
        $this->assertTrue(Schema::hasTable('chats'));
    }

    /** @test */
    public function it_has_expected_columns_in_chats_table()
    {
        $expectedColumns = [
            'id',
            'telegram_chat_id',
            'type',
            'status',
            'username',
            'first_name',
            'last_name',
            'bio',
            'bot_id',
            'user_id',
            'created_at',
            'updated_at',
        ];

        $tableColumns = Schema::getColumnListing('chats');

        $this->assertEquals($expectedColumns, $tableColumns);
    }

    /** @test */
    public function it_can_create_a_chat()
    {
        $bot  = Bot::factory()->create();
        $user = User::factory()->create();

        $chatData = [
            'telegram_chat_id' => 123456789,
            'type'             => ChatType::PRIVATE,
            'status'           => ChatStatus::MEMBER,
            'username'         => FakeUsername::generate(),
            'first_name'       => 'John',
            'last_name'        => 'Doe',
            'bio'              => 'Test chat bio',
            'bot_id'           => $bot->id,
            'user_id'          => $user->id,
        ];

        $chat = Chat::create($chatData);

        $this->assertInstanceOf(Chat::class, $chat);
        $this->assertEquals($chatData['telegram_chat_id'], $chat->telegram_chat_id);
        $this->assertEquals($chatData['type'], $chat->type);
        $this->assertEquals($chatData['status'], $chat->status);
        $this->assertEquals($chatData['username'], $chat->username);
        $this->assertEquals($chatData['first_name'], $chat->first_name);
        $this->assertEquals($chatData['last_name'], $chat->last_name);
        $this->assertEquals($chatData['bio'], $chat->bio);
        $this->assertEquals($chatData['bot_id'], $chat->bot_id);
        $this->assertEquals($chatData['user_id'], $chat->user_id);
    }
}