<?php

namespace App\Actions;

use App\Data\LoginData;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Validation\ValidationException;

class Login
{
    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function __invoke(LoginData $data)
    {
        $credentials = [
            'username' => $data->getUsername(),
            'password' => $data->getPassword(),
        ];

        $remember = $data->getRemember();

        if (!$this->guard->attempt($credentials, $remember)) {
            throw ValidationException::withMessages(['password' => 'Incorrect password. Please try again.']);
        }

		return new UserResource($this->guard->user());
	}
}
