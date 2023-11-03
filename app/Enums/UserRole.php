<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum UserRole: string
{
	use EnumToArray;

    case ROOT = 'root';
    case USER = 'user';
}