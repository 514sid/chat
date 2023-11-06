<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatResource extends JsonResource
{
	public static $wrap = null;

	public static $relationships = ['bot', 'latestUpdate'];

    public function toArray(Request $request): array
    {
        return [
			'id'            => $this->id,
			'status'        => $this->status,
			'username'      => $this->username,
			'first_name'    => $this->first_name,
			'last_name'     => $this->last_name,
			'bot'           => new BotResource($this->bot),
			'created_at'    => $this->created_at,
			'latest_update' => new ChatHistoryItemResource($this->latestUpdate),
		];
    }
}
