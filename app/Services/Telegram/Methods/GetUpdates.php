<?php

namespace App\Services\Telegram\Methods;

use Illuminate\Support\Collection;
use App\Services\Telegram\Types\TelegramUpdate;
use App\Exceptions\InvalidTelegramTokenException;

trait GetUpdates
{
	public function getUpdates(int $offset = 0): ?Collection
	{
		try {
			$response = $this->sendGetRequest('getUpdates', [
				'offset'  => $offset,
				'timeout' => 30
			]);

			if(!$response) {
				return null;
			}

			return $this->processUpdates($response);
        } catch (InvalidTelegramTokenException $e) {
           return null;
        }
	}

	private function processUpdates(
		array $updates
	): Collection {
		$result = collect();

        foreach ($updates as $update) {
            $result->push(new TelegramUpdate($update));
        }

        return $result;
	}
}
