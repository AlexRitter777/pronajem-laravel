<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Calculation;

use App\Domains\ServiceSettlement\Dto\Calculation\HeatingResult;
use Brick\Math\BigDecimal;
use Brick\Math\RoundingMode;
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

        $fixedAmountPerDay = $heatingFixedAmount->getAmount()
            ->dividedBy($daysInYear, 4, RoundingMode::HALF_UP);

        $fixedAmountPerPeriod = Money::of($fixedAmountPerDay->multipliedBy($occupancyDays)
            ->toScale(2, RoundingMode::HALF_UP), 'CZK');

        $annualConsumption = null;
        $calculatedUnitPrice = null;

        if($hasAnnualConsumptionComponent) {
            $annualConsumption = $endYearReading->minus($startYearReading);
            $calculatedUnitPrice = $annualConsumptionAmount->getAmount()
                ->dividedBy($annualConsumption, 4, RoundingMode::HALF_UP);
            $consumptionAmount = Money::of($calculatedUnitPrice->multipliedBy($tenantConsumption)
                ->toScale(2, RoundingMode::HALF_UP), 'CZK');
        }else{
            $consumptionAmount = $heatingUnitPrice->multipliedBy($tenantConsumption, RoundingMode::HALF_UP);
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
