<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ChatType: string
{
	use EnumToArray;

    case PRIVATE    = 'private';
    case GROUP      = 'group';
    case SUPERGROUP = 'supergroup';
    case CHANNEL    = 'channel';
}