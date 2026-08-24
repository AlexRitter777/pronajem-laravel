<?php

declare(strict_types=1);


use App\Domains\ServiceSettlement\Calculation\MeterCalculator;
use App\Domains\ServiceSettlement\Dto\Calculation\SingleMeterResult;
use App\Domains\ServiceSettlement\Dto\HeatingCoefficientsData;
use App\Domains\ServiceSettlement\Dto\MeterData;
use App\Enums\MeterType;
use Brick\Math\BigDecimal;

it('calculates meters consumption for single meters without coefficients', function () {

    $meters = [

        $heatingMeter = new MeterData(
            id: 123,
            meterTypeId: MeterType::HEATING,
            meterTypeName: 'Heating meter',
            meterNumber: '123456789',
            startValue: BigDecimal::of('10.00'),
            endValue: BigDecimal::of('16.00'), //6
        ),

        $hotWaterMeter = new MeterData(
            id: 456,
            meterTypeId: MeterType::HOT_WATER,
            meterTypeName: 'Hot water meter',
            meterNumber: '987654321',
            startValue: BigDecimal::of('12.00'),
            endValue: BigDecimal::of('15.00'), //3
        ),

        $coldWaterMeter = new MeterData(
            id: 789,
            meterTypeId: MeterType::COLD_WATER,
            meterTypeName: 'Cold water meter',
            meterNumber: '098765432',
            startValue: BigDecimal::of('14.00'),
            endValue: BigDecimal::of('18.00'), //4
        )
    ];

    $coefficients = new HeatingCoefficientsData(
        firstCoefficient: null,
        secondCoefficient: null,
        thirdCoefficient: null,
    );

    $result = app(MeterCalculator::class)->calculate($meters, $coefficients);

    expect($result->hotWaterTotalReading->isEqualTo('3.00'))->toBeTrue()
        ->and($result->coldWaterTotalReading->isEqualTo('4.00'))->toBeTrue()
        ->and($result->heatingTotalReading->isEqualTo('6.00'))->toBeTrue()
        ->and($result->meters)->toHaveCount(3)
        ->and($result->meters)->each->toBeInstanceOf(SingleMeterResult::class)

        ->and($result->meters[0]->meterNumber)->toBe('123456789')
        ->and($result->meters[0]->meterType)->toBe(MeterType::HEATING)
        ->and($result->meters[0]->coefficient->isEqualTo('1.00'))->toBeTrue()
        ->and($result->meters[0]->totalReading->isEqualTo('6.00'))->toBeTrue()

        ->and($result->meters[1]->meterNumber)->toBe('987654321')
        ->and($result->meters[1]->meterType)->toBe(MeterType::HOT_WATER)
        ->and($result->meters[1]->coefficient)->toBeNull()
        ->and($result->meters[1]->totalReading->isEqualTo('3.00'))->toBeTrue()

        ->and($result->meters[2]->meterNumber)->toBe('098765432')
        ->and($result->meters[2]->meterType)->toBe(MeterType::COLD_WATER)
        ->and($result->meters[2]->coefficient)->toBeNull()
        ->and($result->meters[2]->totalReading->isEqualTo('4.00'))->toBeTrue()
    ;

});

it('calculates meters consumption for two hot water, two cold water and one heating meters without coefficients', function () {

    $meters = [

        $heatingMeter = new MeterData(
            id: 123,
            meterTypeId: MeterType::HEATING,
            meterTypeName: 'Heating meter',
            meterNumber: '123456789',
            startValue: BigDecimal::of('10.00'),
            endValue: BigDecimal::of('16.00'), //6
        ),

        $hotWaterMeterOne = new MeterData(
            id: 456,
            meterTypeId: MeterType::HOT_WATER,
            meterTypeName: 'Hot water meter',
            meterNumber: '987654321',
            startValue: BigDecimal::of('12.00'),
            endValue: BigDecimal::of('15.00'), //3
        ),


        $hotWaterMeterTwo = new MeterData(
            id: 457,
            meterTypeId: MeterType::HOT_WATER,
            meterTypeName: 'Hot water meter',
            meterNumber: '987654322',
            startValue: BigDecimal::of('10.00'),
            endValue: BigDecimal::of('18.50'), //8.5
        ),

        $coldWaterMeterOne = new MeterData(
            id: 789,
            meterTypeId: MeterType::COLD_WATER,
            meterTypeName: 'Cold water meter',
            meterNumber: '098765432',
            startValue: BigDecimal::of('14.00'),
            endValue: BigDecimal::of('18.00'), //4
        ),

        $coldWaterMeterTwo = new MeterData(
            id: 789,
            meterTypeId: MeterType::COLD_WATER,
            meterTypeName: 'Cold water meter',
            meterNumber: '098765433',
            startValue: BigDecimal::of('14.00'),
            endValue: BigDecimal::of('18.35'), //4.35
        )
    ];

    // Totals:
    // Heating - 6
    // Hot Water - 11.5
    // Cold Water - 8.35

    $coefficients = new HeatingCoefficientsData(
        firstCoefficient: null,
        secondCoefficient: null,
        thirdCoefficient: null,
    );

    $result = app(MeterCalculator::class)->calculate($meters, $coefficients);

    expect($result->hotWaterTotalReading->isEqualTo('11.50'))->toBeTrue()
        ->and($result->coldWaterTotalReading->isEqualTo('8.35'))->toBeTrue()
        ->and($result->heatingTotalReading->isEqualTo('6.00'))->toBeTrue()
        ->and($result->meters)->toHaveCount(5)
        ->and($result->meters)->each->toBeInstanceOf(SingleMeterResult::class)
    ;
});


it('calculates meters consumption for single meters with two coefficients', function () {

    $meters = [

        $heatingMeter = new MeterData(
            id: 123,
            meterTypeId: MeterType::HEATING,
            meterTypeName: 'Heating meter',
            meterNumber: '123456789',
            startValue: BigDecimal::of('10.00'),
            endValue: BigDecimal::of('16.00'), //6
        ),

        $hotWaterMeter = new MeterData(
            id: 456,
            meterTypeId: MeterType::HOT_WATER,
            meterTypeName: 'Hot water meter',
            meterNumber: '987654321',
            startValue: BigDecimal::of('12.00'),
            endValue: BigDecimal::of('15.00'), //3
        ),

        $coldWaterMeter = new MeterData(
            id: 789,
            meterTypeId: MeterType::COLD_WATER,
            meterTypeName: 'Cold water meter',
            meterNumber: '098765432',
            startValue: BigDecimal::of('14.00'),
            endValue: BigDecimal::of('18.00'), //4
        )
    ];

    $coefficients = new HeatingCoefficientsData(
        firstCoefficient: BigDecimal::of('1.50'),
        secondCoefficient: BigDecimal::of('0.2'),
        thirdCoefficient: null,
    );
    // coefficients = 1.5 * 0.2 = 0.3
    // heating Total 6 * 0.3 = 1.8

    $result = app(MeterCalculator::class)->calculate($meters, $coefficients);

    expect($result->hotWaterTotalReading->isEqualTo('3.00'))->toBeTrue()
        ->and($result->coldWaterTotalReading->isEqualTo('4.00'))->toBeTrue()
        ->and($result->heatingTotalReading->isEqualTo('1.80'))->toBeTrue()
        ->and($result->meters)->toHaveCount(3)
        ->and($result->meters)->each->toBeInstanceOf(SingleMeterResult::class)

        ->and($result->meters[0]->meterNumber)->toBe('123456789')
        ->and($result->meters[0]->meterType)->toBe(MeterType::HEATING)
        ->and($result->meters[0]->coefficient->isEqualTo('0.30'))->toBeTrue()
        ->and($result->meters[0]->totalReading->isEqualTo('1.80'))->toBeTrue()

        ->and($result->meters[1]->meterNumber)->toBe('987654321')
        ->and($result->meters[1]->meterType)->toBe(MeterType::HOT_WATER)
        ->and($result->meters[1]->coefficient)->toBeNull()
        ->and($result->meters[1]->totalReading->isEqualTo('3.00'))->toBeTrue()

        ->and($result->meters[2]->meterNumber)->toBe('098765432')
        ->and($result->meters[2]->meterType)->toBe(MeterType::COLD_WATER)
        ->and($result->meters[2]->coefficient)->toBeNull()
        ->and($result->meters[2]->totalReading->isEqualTo('4.00'))->toBeTrue()
    ;

});


it('calculates meters consumption for only for heating and cold water meters without coefficients', function () {

    $meters = [

        $heatingMeter = new MeterData(
            id: 123,
            meterTypeId: MeterType::HEATING,
            meterTypeName: 'Heating meter',
            meterNumber: '123456789',
            startValue: BigDecimal::of('10.00'),
            endValue: BigDecimal::of('16.00'), //6
        ),


        $coldWaterMeter = new MeterData(
            id: 789,
            meterTypeId: MeterType::COLD_WATER,
            meterTypeName: 'Cold water meter',
            meterNumber: '098765432',
            startValue: BigDecimal::of('14.00'),
            endValue: BigDecimal::of('18.00'), //4
        )
    ];

    $coefficients = new HeatingCoefficientsData(
        firstCoefficient: null,
        secondCoefficient: null,
        thirdCoefficient: null,
    );

    $result = app(MeterCalculator::class)->calculate($meters, $coefficients);

    expect($result->hotWaterTotalReading->isEqualTo('0.00'))->toBeTrue()
        ->and($result->coldWaterTotalReading->isEqualTo('4.00'))->toBeTrue()
        ->and($result->heatingTotalReading->isEqualTo('6.00'))->toBeTrue()
        ->and($result->meters)->toHaveCount(2)
        ->and($result->meters)->each->toBeInstanceOf(SingleMeterResult::class);

});
