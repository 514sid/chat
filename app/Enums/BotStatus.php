<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum BotStatus: string
{
	use EnumToArray;

    case ACTIVE      = 'active';
    case DISABLED    = 'disabled';
    case TOKEN_ERROR = 'token_error';
}