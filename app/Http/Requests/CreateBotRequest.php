<?php

namespace App\Http\Requests;

use App\Data\CreateBotData;
use Illuminate\Foundation\Http\FormRequest;

class CreateBotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
			'token' => [
				'required',
				'string'
			]
        ];
    }

	public function toData(): CreateBotData
	{
		return new CreateBotData(
			token: $this->validated('token'),
		);
	}
}
