<?php

namespace App\Data;

class CreateBotData
{
	private string $token;

	public function __construct(
		string $token,
	) {
		$this->token = $token;
	}

	public function getToken(): string
	{
		return $this->token;
	}

	public function toArray(): array
	{
		return [
			'token' => $this->getToken(),
		];
	}
}
