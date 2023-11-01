<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BotResource extends JsonResource
{
	public static $wrap = null;

    public function toArray(Request $request): array
    {
        return [
			'name'                 => $this->name,
			'username'             => $this->username,
			'description'          => $this->description,
			'short_description'    => $this->short_description,
			'updates_retrieved_at' => $this->updates_retrieved_at,
		];
    }
}
