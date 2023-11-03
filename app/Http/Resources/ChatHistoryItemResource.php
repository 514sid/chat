<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ChatHistoryItemResource extends JsonResource
{
	public static $wrap = null;

	public static $relationships = ['item'];

    public function toArray(Request $request): array
    {
        return [
			'id'        => $this->id,
			'date'      => $this->date,
			'item'      => $this->item,
			'item_type' => $this->item_type,
		];
    }
}