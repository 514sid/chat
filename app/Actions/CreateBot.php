<?php

namespace App\Actions;

use Exception;
use App\Models\Bot;
use Telegram\Bot\Api;
use App\Data\CreateBotData;
use App\Http\Resources\BotResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Telegram\Bot\Objects\User as TelegramUser;

class CreateBot
{
	private Api $api;

	public function __invoke(
		CreateBotData $data,
	): BotResource | ValidationException | JsonResponse {
		$this->api = app(Api::class);

		$response = $this->getTelegramBotInfo($data->getToken());

		if (!$response) {
			return response()->json(['error' => 'Something went wrong'], 500);
		}

		$this->validateReponse($response);

		$botData = $this->prepareBotData($response, $data->getToken());

		$bot = $this->createBot($botData);

		return new BotResource($bot);
	}

	private function getTelegramBotInfo(
		string $token
	): ?TelegramUser {
		try {
			$this->api->setAccessToken($token);

			return $this->api->getMe();
		} catch (Exception $e) {
			if ($e->getCode() === 401 || $e->getCode() === 404) {
				throw ValidationException::withMessages([
					'token' => 'Invalid token',
				]);
			}
		}

		return null;
	}

	private function validateReponse(
		TelegramUser $response
	): void {
		$rules = [
			'id' => [
				'unique:bots,telegram_id'
			],
		];

		$messages = [
			'id.unique' => 'Bot is already added',
		];

		$validator = Validator::make($response->toArray(), $rules, $messages);

		if ($validator->fails()) {
			throw new ValidationException($validator);
		}
	}

	private function prepareBotData(
		TelegramUser $bot,
		string $token,
	): array {
		return [
			'telegram_id' => $bot->id,
			'name'        => $bot->firstName,
			'username'    => $bot->username,
			'token'       => $token,
		];
	}

	private function createBot(
		array $botData
	): Bot {
		return Bot::create($botData);
	}
}
