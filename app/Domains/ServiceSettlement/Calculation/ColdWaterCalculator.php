<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Calculation;

use App\Domains\ServiceSettlement\Dto\Calculation\ColdWaterResult;
use Brick\Math\BigDecimal;
use Brick\Money\Money;

final class ColdWaterCalculator
{
    public function calculate(
        Money $coldWaterUnitPrice,
        BigDecimal $tenantConsumption,
    ) : ColdWaterResult
    {

        $totalAmount = $coldWaterUnitPrice->multipliedBy($tenantConsumption);

        return new ColdWaterResult(
            unitPrice: $coldWaterUnitPrice,
            totalAmount: $totalAmount,
        );

    }

}
