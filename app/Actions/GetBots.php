<?php

namespace App\Actions;

use App\Models\Bot;
use App\Http\Resources\BotResource;

class GetBots
{
	public function __invoke()
	{
		$chats = Bot::all();

		return BotResource::collection($chats);
	}
}