<?php

namespace App\Services\Telegram\Methods;

use App\Services\Telegram\Types\TelegramUser;
use App\Exceptions\InvalidTelegramTokenException;

trait GetMe
{
	public function getMe(): TelegramUser | null
	{
		try {
            $response = $this->sendGetRequest('getMe');

			$telegramUser = new TelegramUser(
				$response
			);

			return $telegramUser;
        } catch (InvalidTelegramTokenException $e) {
           return null;
        }
	}
}
