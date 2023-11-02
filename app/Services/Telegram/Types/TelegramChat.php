<?php

namespace App\Services\Telegram\Types;

use stdClass;
use App\Enums\ChatType;

class TelegramChat
{
	private int $id;
	private ChatType $type;
	private ?string $username;
	private ?string $first_name;
	private ?string $last_name;

	public function __construct(
		stdClass $properties,
	) {
		$this->id         = $properties->id;
		$this->type       = ChatType::tryFrom($properties->type);
		$this->username   = $properties->username ?? null;
		$this->first_name = $properties->first_name ?? null;
		$this->last_name  = $properties->last_name ?? null;
	}

	public function getId(): int
	{
		return $this->id;
	}

	public function getType(): ChatType
	{
		return $this->type;
	}

	public function getUsername(): ?string
	{
		return $this->username;
	}

	public function getFirstName(): ?string
	{
		return $this->first_name;
	}

	public function getLastName(): ?string
	{
		return $this->last_name;
	}
}
