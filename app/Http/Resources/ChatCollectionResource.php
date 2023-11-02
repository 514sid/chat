<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatCollectionResource extends JsonResource
{
	public static $wrap = null;

	public static $relationships = ['latestUpdate', 'latestUpdate.item', 'bot'];

    public function toArray(Request $request): array
    {
        return [
			'id'            => $this->id,
			'status'        => $this->status,
			'first_name'    => $this->first_name,
			'last_name'     => $this->last_name,
			'latest_update' => $this->latestUpdate,
			'bot'           => new BotResource($this->bot),
		];
    }
}
