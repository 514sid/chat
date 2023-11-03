<?php

namespace App\Actions;

use Illuminate\Contracts\Auth\StatefulGuard;

class Logout
{
    protected $guard;

    public function __construct(StatefulGuard $guard)
    {
        $this->guard = $guard;
    }

    public function __invoke()
    {
        $this->guard->logout();

        return;
    }
}
