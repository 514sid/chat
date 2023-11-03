<?php

namespace App\Actions;

use App\Models\Chat;
use App\Http\Resources\ChatResource;

class GetChat
{
	public function __invoke(Chat $chat)
	{
		return new ChatResource($chat);
	}
}