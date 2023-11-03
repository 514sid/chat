<?php

namespace App\Actions;

use App\Models\User;
use App\Data\CreateUserData;
use App\Http\Resources\UserResource;

class CreateUser
{
    public function __invoke(CreateUserData $data)
    {
        $user = User::create($data->toArray());

        return new UserResource($user);
    }
}
