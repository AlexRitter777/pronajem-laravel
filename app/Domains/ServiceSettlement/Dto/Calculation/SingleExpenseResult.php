<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto\Calculation;

use Brick\Math\BigDecimal;
use Brick\Money\Money;

final readonly class SingleExpenseResult
{

    public function __construct(
        public string $expenseType,
        public Money $annualAmount,
        public BigDecimal $amountPerDay,
        public Money $amountPerPeriod,
    ){}

}
