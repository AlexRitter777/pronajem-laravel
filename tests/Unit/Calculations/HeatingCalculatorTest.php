<?php

use App\Domains\ServiceSettlement\Calculation\HeatingCalculator;
use Brick\Math\BigDecimal;
use Brick\Money\Money;

it('calculates heating costs without annual consumption component', function () {

    $result = app(HeatingCalculator::class)->calculate(
        heatingFixedAmount: Money::of('5638.30', 'CZK'),
        daysInYear: 366,
        occupancyDays: 121,
        tenantConsumption: BigDecimal::of('6.7750'),
        hasAnnualConsumptionComponent: false,
        heatingUnitPrice: Money::of('758.17', 'CZK'),
        annualConsumptionAmount: null,
        startYearReading: null,
        endYearReading: null,
    );

    // fixedAmountPerDay = 5638.30 / 366 = 15.4052 Kč/den
    // fixedAmountPerPeriod = 15.4052 x 121 = 1864.03 Kč
    // consumptionAmount = 758.17 x 6.7750 = 5136.60 Kč
    // totalAmount = 1864.03 + 5136.60 = 7000.63 Kč

    expect($result->annualFixedAmount->isEqualTo('5638.30'))->toBeTrue()
        ->and((string) $result->fixedAmountPerDay)->toBe('15.4052')
        ->and($result->fixedAmountPerPeriod->isEqualTo('1864.03'))->toBeTrue()
        ->and($result->hasAnnualConsumptionComponent)->toBeFalse()
        ->and($result->unitPrice->isEqualTo('758.17'))->toBeTrue()
        ->and($result->correctedAnnualConsumptionAmount)->toBeNull()
        ->and($result->startYearReading)->toBeNull()
        ->and($result->endYearReading)->toBeNull()
        ->and($result->annualConsumption)->toBeNull()
        ->and($result->calculatedUnitPrice)->toBeNull()
        ->and($result->consumptionAmount->isEqualTo('5136.60'))->toBeTrue()
        ->and($result->totalAmount->isEqualTo('7000.63'))->toBeTrue()
    ;

});

it('calculates heating costs with annual consumption component', function () {

    $result = app(HeatingCalculator::class)->calculate(
        heatingFixedAmount: Money::of('5638.30', 'CZK'),
        daysInYear: 366,
        occupancyDays: 121,
        tenantConsumption: BigDecimal::of('6.7750'),
        hasAnnualConsumptionComponent: true,
        heatingUnitPrice: null,
        annualConsumptionAmount: Money::of('62480.00', 'CZK'),
        startYearReading: BigDecimal::of('1268.00'),
        endYearReading: BigDecimal::of('1452.00'),
    );

    // fixedAmountPerDay = 5638.30 / 366 = 15.4052 Kč/den
    // fixedAmountPerPeriod = 15.4052 x 121 = 1864.03 Kč
    // annualConsumption = 1452 - 1268 = 184.00
    // calculatedUnitPrice = 62480 / 184 = 339.5652 Kč/jedn.
    // consumptionAmount = 339.5652 x 6.7750 = 2300.55 Kč
    // totalAmount = 1864.03 + 2300.55 = 4164.58 Kč

    expect($result->annualFixedAmount->isEqualTo('5638.30'))->toBeTrue()
        ->and((string) $result->fixedAmountPerDay)->toBe('15.4052')
        ->and($result->fixedAmountPerPeriod->isEqualTo('1864.03'))->toBeTrue()
        ->and($result->hasAnnualConsumptionComponent)->toBeTrue()
        ->and($result->unitPrice)->toBeNull()
        ->and($result->correctedAnnualConsumptionAmount->isEqualTo('62480.00'))->toBeTrue()
        ->and($result->startYearReading->isEqualTo('1268.00'))->toBeTrue()
        ->and($result->endYearReading->isEqualTo('1452.00'))->toBeTrue()
        ->and($result->annualConsumption->isEqualTo('184.00'))->toBeTrue()
        ->and((string) $result->calculatedUnitPrice)->toBe('339.5652')
        ->and($result->consumptionAmount->isEqualTo('2300.55'))->toBeTrue()
        ->and($result->totalAmount->isEqualTo('4164.58'))->toBeTrue();
});
