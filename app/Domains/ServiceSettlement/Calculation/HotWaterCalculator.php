<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Calculation;

use App\Domains\ServiceSettlement\Dto\Calculation\HotWaterResult;
use Brick\Math\BigDecimal;
use Brick\Money\Money;

final class HotWaterCalculator
{
    public function calculate(
        Money $hotWaterFixedAmount,
        int $daysInYear,
        int $occupancyDays,
        BigDecimal $tenantConsumption,
        Money $hotWaterUnitPrice,
        ?Money $coldWaterForHotUnitPrice,
    ) : HotWaterResult
    {

        $fixedAmountPerDay = $hotWaterFixedAmount->dividedBy($daysInYear);

        $fixedAmountPerPeriod = $fixedAmountPerDay->multipliedBy($occupancyDays);

        $consumptionAmount = $hotWaterUnitPrice->multipliedBy($tenantConsumption);

        $coldWaterForHotConsumptionAmount = $coldWaterForHotUnitPrice?->multipliedBy($tenantConsumption);

        $totalAmount = $fixedAmountPerPeriod->plus($consumptionAmount);

        if($coldWaterForHotConsumptionAmount !== null) {
            $totalAmount = $totalAmount->plus($coldWaterForHotConsumptionAmount);
        }

        return new HotWaterResult(
            annualFixedAmount: $hotWaterFixedAmount,
            fixedAmountPerDay: $fixedAmountPerDay,
            fixedAmountPerPeriod: $fixedAmountPerPeriod,
            tenantConsumption: $tenantConsumption,
            unitPrice: $hotWaterUnitPrice,
            consumptionAmount: $consumptionAmount,
            coldWaterForHotUnitPrice: $coldWaterForHotUnitPrice,
            coldWaterForHotConsumptionAmount: $coldWaterForHotConsumptionAmount,
            totalAmount: $totalAmount,
        );

    }

}
