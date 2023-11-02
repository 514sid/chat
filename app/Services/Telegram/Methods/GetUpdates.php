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
				'offset' => $offset
			]);

			return $this->processUpdates($response);
        } catch (InvalidTelegramTokenException $e) {
           return null;
        }
	}

	private function processUpdates(
		array $updates
	): Collection {
		$count = count($updates);
		$result = collect();
		$index = 0;

		if($count > 0) {
			do {
				$result->push(new TelegramUpdate($updates[$index]));
				$index++;
			} while ($index < $count);
		}

		return $result;
	}
}
