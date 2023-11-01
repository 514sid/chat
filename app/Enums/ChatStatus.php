<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ChatStatus: string
{
	use EnumToArray;

    case KICKED = 'kicked';
    case MEMBER = 'member';
}