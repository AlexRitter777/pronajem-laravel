<?php

use App\Domains\ServiceSettlement\Calculation\ColdWaterCalculator;
use Brick\Math\BigDecimal;
use Brick\Money\Money;

it('calculates cold water costs', function () {

    $result = app(ColdWaterCalculator::class)->calculate(
        coldWaterUnitPrice: Money::of('10', 'CZK'),
        tenantConsumption: BigDecimal::of(50),
    );

    // totalAmount = 50 x 10 = 500 Kč

    expect($result->unitPrice->isEqualTo('10'))->toBeTrue()
        ->and($result->totalAmount->isEqualTo('500'))->toBeTrue()
    ;

});
