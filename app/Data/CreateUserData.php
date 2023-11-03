<?php

namespace App\Data;

use App\Enums\UserRole;
use Illuminate\Support\Facades\Hash;

class CreateUserData
{
    private string $username;
    private string $password;
    private UserRole $role;

    public function __construct(
        string $username,
        string $password,
        UserRole $role
    ) {
        $this->username = $username;
        $this->password = Hash::make($password);
        $this->role     = $role;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function getRole(): UserRole
    {
        return $this->role;
    }

    public function toArray(): array
    {
        return [
            'username' => $this->username,
            'password' => $this->password,
            'role'     => $this->role,
        ];
    }
}
