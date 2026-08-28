<?php

use App\Domains\ServiceSettlement\Calculation\HotWaterCalculator;
use Brick\Math\BigDecimal;
use Brick\Money\Money;

it('calculates hot water costs without cold water component', function () {

    $result = app(HotWaterCalculator::class)->calculate(
        hotWaterFixedAmount: Money::of('3650', 'CZK'),
        daysInYear: 365,
        occupancyDays: 100,
        tenantConsumption: BigDecimal::of(50),
        hotWaterUnitPrice: Money::of('10', 'CZK'),
        coldWaterForHotUnitPrice: null,
    );

    // fixedAmountPerDay = 3650 / 365 = 10 Kč
    // fixedAmountPerPeriod = 100 x 10 = 1000 Kč
    // consumptionAmount = 50 x 10 = 500 Kč
    // totalAmount = 1000 + 500 = 1500 Kč

    expect($result->annualFixedAmount->isEqualTo('3650'))->toBeTrue()
        ->and($result->fixedAmountPerDay->isEqualTo('10'))->toBeTrue()
        ->and($result->fixedAmountPerPeriod->isEqualTo('1000'))->toBeTrue()
        ->and($result->unitPrice->isEqualTo('10'))->toBeTrue()
        ->and($result->consumptionAmount->isEqualTo('500'))->toBeTrue()
        ->and($result->coldWaterForHotUnitPrice)->toBeNull()
        ->and($result->coldWaterForHotConsumptionAmount)->toBeNull()
        ->and($result->totalAmount->isEqualTo('1500'))->toBeTrue()
    ;

});

it('calculates hot water costs with cold water component', function () {

    $result = app(HotWaterCalculator::class)->calculate(
        hotWaterFixedAmount: Money::of('3650', 'CZK'),
        daysInYear: 365,
        occupancyDays: 100,
        tenantConsumption: BigDecimal::of(50),
        hotWaterUnitPrice: Money::of('10', 'CZK'),
        coldWaterForHotUnitPrice: Money::of('5', 'CZK'),
    );

    // fixedAmountPerDay = 3650 / 365 = 10 Kč
    // fixedAmountPerPeriod = 100 x 10 = 1000 Kč
    // consumptionAmount = 50 x 10 = 500 Kč
    // coldWaterConsumptionAmount = 50 x 5 = 250 Kč
    // totalAmount = 1000 + 500 + 250 = 1750 Kč

    expect($result->annualFixedAmount->isEqualTo('3650'))->toBeTrue()
        ->and($result->fixedAmountPerDay->isEqualTo('10'))->toBeTrue()
        ->and($result->fixedAmountPerPeriod->isEqualTo('1000'))->toBeTrue()
        ->and($result->unitPrice->isEqualTo('10'))->toBeTrue()
        ->and($result->consumptionAmount->isEqualTo('500'))->toBeTrue()
        ->and($result->coldWaterForHotUnitPrice->isEqualTo('5'))->toBeTrue()
        ->and($result->coldWaterForHotConsumptionAmount->isEqualTo('250'))->toBeTrue()
        ->and($result->totalAmount->isEqualTo('1750'))->toBeTrue()
    ;

});
