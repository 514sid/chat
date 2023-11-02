<?php

namespace App\Actions;

use App\Models\Bot;
use App\Models\Chat;
use App\Enums\ChatStatus;
use App\Services\Telegram\Types\TelegramChat;

class UpdateChat
{
	public function __invoke(
		TelegramChat $telegram_chat,
		Bot $bot,
		ChatStatus $status = ChatStatus::MEMBER
	): ?Chat
	{
		$chat = Chat::updateOrCreate(
			[
				'telegram_chat_id' => $telegram_chat->getId(),
				'bot_id'  	 	   => $bot->id
			],
			[
				'status'     => $status,
				'type'       => $telegram_chat->getType(),
				'username'   => $telegram_chat->getUsername(),
				'first_name' => $telegram_chat->getFirstName(),
				'last_name'  => $telegram_chat->getLastName(),
			]
		);

		return $chat;
	}
}