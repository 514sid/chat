<?php

namespace App\Data;

class LoginData
{
	private string $username;
	private string $password;
	private bool   $remember;

	public function __construct(
		string $username,
		string $password,
		bool $remember = false
	) {
		$this->username = $username;
		$this->password = $password;
		$this->remember = $remember;
	}

	public function getUsername(): string
	{
		return $this->username;
	}

	public function getPassword(): string
	{
		return $this->password;
	}

	public function getRemember(): bool
	{
		return $this->remember;
	}

	public function toArray(): array
	{
		return [
			'username' => $this->username,
			'password' => $this->password,
			'remember' => $this->remember,
		];
	}
}
