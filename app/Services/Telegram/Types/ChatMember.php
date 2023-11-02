<?php

namespace App\Services\Telegram\Types;

use stdClass;
use App\Enums\ChatStatus;

class ChatMember
{
	private ?ChatStatus $status;
	private TelegramUser $user;

	public function __construct(
		stdClass $properties,
	) {
		$this->status = ChatStatus::tryFrom($properties->status ?? null);
		$this->user   = new TelegramUser($properties->user);
	}

	public function getStatus(): ?ChatStatus
	{
		return $this->status;
	}

	public function getUser(): TelegramUser
	{
		return $this->user;
	}
}
