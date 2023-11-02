<?php

namespace App\Services\Telegram\Types;

use stdClass;
use Carbon\Carbon;
use App\Services\Telegram\Types\TelegramUser;
use App\Services\Telegram\Types\TelegramEntityType;

class ChatMemberUpdated extends TelegramEntityType
{
	private TelegramUser $from;
	private Carbon $date;
	private ChatMember $old_chat_member;
	private ChatMember $new_chat_member;

	public function __construct(
		stdClass $properties,
	) {
		$this->from = new TelegramUser(
			$properties->from
		);

		$this->old_chat_member = new ChatMember($properties->old_chat_member);

		$this->new_chat_member = new ChatMember($properties->new_chat_member);

		$this->date = Carbon::createFromTimestamp($properties->date);

		$this->setChat($properties);
	}

	public function getFrom(): TelegramUser
	{
		return $this->from;
	}

	public function getDate(): Carbon
	{
		return $this->date;
	}

	public function getOldChatMember(): ChatMember
	{
		return $this->old_chat_member;
	}

	public function getNewChatMember(): ChatMember
	{
		return $this->new_chat_member;
	}
}
