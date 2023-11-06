<?php

namespace App\Actions;

use App\Models\Chat;
use App\Http\Resources\ChatHistoryItemResource;

class GetChatHistory
{
	public function __invoke(Chat $chat)
	{
		$history = $chat->history()->with(ChatHistoryItemResource::$relationships)->get();

		return ChatHistoryItemResource::collection($history);
	}
}