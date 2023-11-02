<?php

namespace App\Actions;

use App\Models\Bot;
use App\Jobs\HandleBotUpdate;
use Illuminate\Support\Collection;
use App\Services\Telegram\TelegramApi;

class GetUpdates
{
	private TelegramApi $api;
	private Bot $bot;

	public function __invoke(
		int $bot_id
	) {
		$this->initialize($bot_id);
		return $this->processUpdates();
	}

	private function initialize(
		int $bot_id
	): void {
		$this->api = app(TelegramApi::class);
		$this->bot = Bot::find($bot_id);
		$this->api->setToken($this->bot->token);
	}

	private function processUpdates(): void
	{
		$updates = $this->api->getUpdates(
			offset: $this->bot->offset
		);

		if (!$updates) {
			return;
		}

		$this->dispatchHandleBotUpdateJobs($updates);

		if ($updates->count() > 0) {
			$this->updateOffset($updates);
			$this->bot->save();
		}
	}

	private function dispatchHandleBotUpdateJobs(
		Collection $updates
	): void {
		$updates->each(function ($update) {
			HandleBotUpdate::dispatch($update, $this->bot->id);
		});
	}

	private function updateOffset(
		Collection $updates
	): void {
		$this->bot->offset = $updates->pop()->getUpdateId() + 1;
	}
}
