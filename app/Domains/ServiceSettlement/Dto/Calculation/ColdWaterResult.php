<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto\Calculation;

use Brick\Money\Money;

final readonly class ColdWaterResult
{
    public function __construct(
        public Money $unitPrice,
        public Money $totalAmount,
    ){}

}
