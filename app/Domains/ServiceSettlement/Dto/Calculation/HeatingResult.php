<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto\Calculation;

use Brick\Math\BigDecimal;
use Brick\Money\Money;

final readonly class HeatingResult
{
    public function __construct(
        public Money $annualFixedAmount,
        public Money $fixedAmountPerDay,
        public Money $fixedAmountPerPeriod,

        public bool $hasAnnualConsumptionComponent,

        public ?Money $unitPrice,

        public ?Money $correctedAnnualConsumptionAmount,
        public ?BigDecimal $startYearReading,
        public ?BigDecimal $endYearReading,
        public ?BigDecimal $annualConsumption,
        public ?Money $calculatedUnitPrice,

        public Money $consumptionAmount,
        public Money $totalAmount,
    ){}

}
