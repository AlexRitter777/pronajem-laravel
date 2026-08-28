<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto\Calculation;

use Brick\Math\BigDecimal;
use Brick\Money\Money;

final readonly class HotWaterResult
{
    public function __construct(
        public Money $annualFixedAmount,
        public Money $fixedAmountPerDay,
        public Money $fixedAmountPerPeriod,

        public Money $unitPrice,
        public Money $consumptionAmount,

        public ?Money $coldWaterForHotUnitPrice,
        public ?Money $coldWaterForHotConsumptionAmount,

        public Money $totalAmount,
    ){}

}
