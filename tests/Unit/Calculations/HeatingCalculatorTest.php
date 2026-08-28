<?php

use App\Domains\ServiceSettlement\Calculation\HeatingCalculator;
use Brick\Math\BigDecimal;
use Brick\Money\Money;

it('calculates heating costs without annual consumption component', function () {

    $result = app(HeatingCalculator::class)->calculate(
        heatingFixedAmount: Money::of('3650', 'CZK'),
        daysInYear: 365,
        occupancyDays: 100,
        tenantConsumption: BigDecimal::of(50),
        hasAnnualConsumptionComponent: false,
        heatingUnitPrice: Money::of('10', 'CZK'),
        annualConsumptionAmount: null,
        startYearReading: null,
        endYearReading: null,
    );

    // fixedAmountPerDay = 3650 / 365 = 10 Kč
    // fixedAmountPerPeriod = 100 x 10 = 1000 Kč
    // consumptionAmount = 50 x 10 = 500 Kč
    // totalAmount = 1000 + 500 = 1500 Kč

    expect($result->annualFixedAmount->isEqualTo('3650'))->toBeTrue()
        ->and($result->fixedAmountPerDay->isEqualTo('10'))->toBeTrue()
        ->and($result->fixedAmountPerPeriod->isEqualTo('1000'))->toBeTrue()
        ->and($result->hasAnnualConsumptionComponent)->toBeFalse()
        ->and($result->unitPrice->isEqualTo('10'))->toBeTrue()
        ->and($result->correctedAnnualConsumptionAmount)->toBeNull()
        ->and($result->startYearReading)->toBeNull()
        ->and($result->endYearReading)->toBeNull()
        ->and($result->calculatedUnitPrice)->toBeNull()
        ->and($result->consumptionAmount->isEqualTo('500'))->toBeTrue()
        ->and($result->totalAmount->isEqualTo('1500'))->toBeTrue()
    ;

});

it('calculates heating costs with annual consumption component', function () {
    $result = app(HeatingCalculator::class)->calculate(
        heatingFixedAmount: Money::of('3650', 'CZK'),
        daysInYear: 365,
        occupancyDays: 100,
        tenantConsumption: BigDecimal::of(50),
        hasAnnualConsumptionComponent: true,
        heatingUnitPrice: null,
        annualConsumptionAmount: Money::of('2000', 'CZK'),
        startYearReading: BigDecimal::of(100),
        endYearReading: BigDecimal::of(200),
    );

    // fixedAmountPerDay = 3650 / 365 = 10 Kč
    // fixedAmountPerPeriod = 100 x 10 = 1000 Kč
    // calculatedUnitPrice = 2000 / (200 -100) = 20 Kč
    // consumptionAmount = 50 x 20 = 1000 Kč
    // totalAmount = 1000 + 1000 = 2000 Kč

    expect($result->annualFixedAmount->isEqualTo('3650'))->toBeTrue()
        ->and($result->fixedAmountPerDay->isEqualTo('10'))->toBeTrue()
        ->and($result->fixedAmountPerPeriod->isEqualTo('1000'))->toBeTrue()
        ->and($result->hasAnnualConsumptionComponent)->toBeTrue()
        ->and($result->unitPrice)->toBeNull()
        ->and($result->correctedAnnualConsumptionAmount->isEqualTo('2000'))->toBeTrue()
        ->and($result->startYearReading->isEqualTo('100'))->toBeTrue()
        ->and($result->endYearReading->isEqualTo('200'))->toBeTrue()
        ->and($result->calculatedUnitPrice->isEqualTo('20'))->toBeTrue()
        ->and($result->consumptionAmount->isEqualTo('1000'))->toBeTrue()
        ->and($result->totalAmount->isEqualTo('2000'))->toBeTrue();
});
