<?php

namespace App\Http\Requests;

use App\Data\LoginData;
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
            'username' => ['required', 'string', 'exists:users,username'],
            'password' => 'required'
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
