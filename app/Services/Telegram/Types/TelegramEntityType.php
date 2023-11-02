<?php

namespace App\Services\Telegram\Types;

use stdClass;
use App\Services\Telegram\Types\TelegramChat;

class TelegramEntityType
{
	protected ?TelegramChat $chat;

	protected function setChat(stdClass $object)
	{
		if (property_exists($object, 'chat')) {
			$this->chat = new TelegramChat(
				$object->chat
			);
		} else {
			$this->chat = null;
		}
	}

	public function getChat(): ?TelegramChat
	{
		return $this->chat;
	}
}
