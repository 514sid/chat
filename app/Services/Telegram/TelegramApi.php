<?php
namespace App\Services\Telegram;

use stdClass;
use GuzzleHttp\Client;
use App\Services\Telegram\Methods\GetMe;
use GuzzleHttp\Exception\GuzzleException;
use App\Services\Telegram\Methods\GetUpdates;
use App\Exceptions\InvalidTelegramTokenException;

class TelegramApi
{
	use GetUpdates, GetMe;

	private ?string $token;

	public function __construct() {
		$this->token = null;
	}

	public function setToken(string $token)
	{
		$this->token = $token;
	}

	public function getUrl(): string
	{
		$baseUrl = 'https://api.telegram.org/bot';

		return "$baseUrl$this->token/";
	}

	public function sendGetRequest(string $endpoint, array $queryParameters = []): stdClass | array | null
	{
		$client = new Client();
	
		try {
			$response = $client->get($this->getUrl() . $endpoint, [
				'query' => $queryParameters,
			]);

			return json_decode($response->getBody()->getContents())->result;
		} catch (GuzzleException $e) {
			if ($e->getCode() === 401 || $e->getCode() === 404) {
				throw new InvalidTelegramTokenException;
			}

			return null;
		}
	}
}