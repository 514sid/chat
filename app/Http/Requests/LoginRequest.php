<?php

namespace App\Http\Requests;

use App\Data\LoginData;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'username' => [
				'required',
				'string',
				Rule::exists('users', 'username')
			],
            'password' => 'required'
        ];
    }

	public function messages(): array
    {
        return [
			'username.required' => "Username is required",
			'username.string'   => "Invalid username format",
			'username.exists'   => "User with that username was not found",
			'password.required' => "Password is required",
        ];
    }

    public function toData(): LoginData
    {
        $username = $this->input('username');
        $password = $this->input('password');
        $remember = $this->input('remember', true);

        return new LoginData(
			username: $username,
			password: $password,
			remember: $remember,
		);
    }
}
