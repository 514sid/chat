<?php

namespace App\Actions;

use App\Models\Bot;
use App\Enums\BotStatus;
use App\Data\CreateBotData;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\BotResource;
use App\Services\Telegram\TelegramApi;
use Illuminate\Support\Facades\Validator;
use App\Services\Telegram\Types\TelegramUser;
use Illuminate\Validation\ValidationException;

class CreateBot
{
	private TelegramApi $api;

	public function __invoke(
		CreateBotData $data,
	): BotResource | ValidationException | JsonResponse {
		$this->api = app(TelegramApi::class);

		$botInfo = $this->getTelegramBotInfo($data->getToken());

		if (!$botInfo) {
			throw ValidationException::withMessages([
				'token' => 'Invalid token',
			]);
		}

		$this->validateReponse($botInfo);

		$botData = $this->prepareBotData($botInfo, $data->getToken());

		$bot = $this->createBot($botData);

		return new BotResource($bot);
	}

	private function getTelegramBotInfo(
		string $token
	) {
		$this->api->setToken($token);

		return $this->api->getMe();
	}

	private function validateReponse(
		TelegramUser $botInfo
	): void {
		$rules = [
			'id' => [
				'unique:bots,telegram_id'
			],
		];

		$messages = [
			'id.unique' => 'Bot is already added',
		];

		$validator = Validator::make([
			'id' => $botInfo->getId()
		], $rules, $messages);

		if ($validator->fails()) {
			throw new ValidationException($validator);
		}
	}

	private function prepareBotData(
		TelegramUser $bot,
		string $token,
	): array {
		return [
			'telegram_id' => $bot->getId(),
			'name'        => $bot->getFirstName(),
			'username'    => $bot->getUsername(),
			'token'       => $token,
			'status'	  => BotStatus::ACTIVE
		];
	}

	private function createBot(
		array $botData
	): Bot {
		return Bot::create($botData);
	}
}
