<?php

namespace App\Actions;

use App\Models\Bot;
use App\Enums\ChatType;
use App\Actions\UpdateChat;
use App\Models\ChatHistoryItem;
use App\Models\ChatStatusUpdate;
use App\Enums\TelegramUpdateType;
use App\Services\Telegram\Types\TelegramChat;
use App\Services\Telegram\Types\TelegramUpdate;
use App\Services\Telegram\Types\ChatMemberUpdated;

class HandleUpdate
{
	private TelegramUpdate $update;
	private Bot $bot;
	private ?TelegramChat $chat;

	public function __invoke(
		TelegramUpdate $update,
		int $bot_id,
	): void {
		$this->update = $update;
		$this->bot = Bot::find($bot_id);
		$entity = $this->update->getEntity();

		$this->chat = $entity ? $entity->getChat() : null;

		if ($this->chat && $this->chat->getType() !== ChatType::PRIVATE) {
			return;
		}

		switch ($this->update->getType()) {
			case TelegramUpdateType::MY_CHAT_MEMBER:
				$this->handleChatStatus();
				break;
		}
	}

	private function handleChatStatus()
	{
		/** @var ChatMemberUpdated $entity */
		$entity = $this->update->getEntity();

		$newStatus = $entity->getNewChatMember()->getStatus();

		$chat = (new UpdateChat)($entity->getChat(), $this->bot, $newStatus);

		$chatStatusUpdate = $this->createChatStatusUpdate($newStatus, $chat->id);

		$historyItem = new ChatHistoryItem();

		$historyItem->date = $entity->getDate();
		$historyItem->chat_id = $chat->id;

		$historyItem->item()->associate($chatStatusUpdate);
		$historyItem->save();
	}

	private function createChatStatusUpdate($newStatus, $chat_id): ChatStatusUpdate
    {
        return ChatStatusUpdate::create([
            'status'  => $newStatus,
            'chat_id' => $chat_id,
        ]);
    }
}
