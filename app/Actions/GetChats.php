<?php

namespace App\Actions;

use App\Models\Chat;
use App\Http\Resources\ChatCollectionResource;

class GetChats
{
	public function __invoke()
	{
		$chats = Chat::orderByLatestUpdate()->with(ChatCollectionResource::$relationships)->get();

		return ChatCollectionResource::collection($chats);
	}
}