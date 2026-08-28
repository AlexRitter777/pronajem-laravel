<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Calculation;

use App\Domains\ServiceSettlement\Dto\Calculation\HeatingResult;
use Brick\Math\BigDecimal;
use Brick\Money\Money;

final class HeatingCalculator
{
    public function calculate(
        Money $heatingFixedAmount,
        int $daysInYear,
        int $occupancyDays,
        BigDecimal $tenantConsumption,
        bool $hasAnnualConsumptionComponent,
        ?Money $heatingUnitPrice,
        ?Money $annualConsumptionAmount,
        ?BigDecimal $startYearReading,
        ?BigDecimal $endYearReading,
    ) : HeatingResult
    {

        $fixedAmountPerDay = $heatingFixedAmount->dividedBy($daysInYear);

        $fixedAmountPerPeriod = $fixedAmountPerDay->multipliedBy($occupancyDays);

        $annualConsumption = null;
        $calculatedUnitPrice = null;

        if($hasAnnualConsumptionComponent) {
            $annualConsumption = $endYearReading->minus($startYearReading);
            $calculatedUnitPrice = $annualConsumptionAmount->dividedBy($annualConsumption);
            $consumptionAmount = $calculatedUnitPrice->multipliedBy($tenantConsumption);
        }else{
            $consumptionAmount = $heatingUnitPrice->multipliedBy($tenantConsumption);
        }

        $totalAmount = $fixedAmountPerPeriod->plus($consumptionAmount);

        return new HeatingResult(
            annualFixedAmount: $heatingFixedAmount,
            fixedAmountPerDay: $fixedAmountPerDay,
            fixedAmountPerPeriod: $fixedAmountPerPeriod,
            hasAnnualConsumptionComponent: $hasAnnualConsumptionComponent,
            unitPrice: $heatingUnitPrice,
            correctedAnnualConsumptionAmount: $annualConsumptionAmount,
            startYearReading: $startYearReading,
            endYearReading: $endYearReading,
            annualConsumption: $annualConsumption,
            calculatedUnitPrice: $calculatedUnitPrice,
            consumptionAmount: $consumptionAmount,
            totalAmount: $totalAmount
        );

    }

}
