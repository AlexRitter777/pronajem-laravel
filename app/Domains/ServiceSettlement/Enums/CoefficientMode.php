<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Enums;

enum CoefficientMode : string
{
    case NONE = 'none';
    case ONE = 'one';
    case MANY = 'many';
}
