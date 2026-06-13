<?php

use App\Domains\ServiceSettlement\Dto\MeterData;
use Brick\Math\BigDecimal;

it('builds from a full array', function () {
    $dto = MeterData::fromArray([
        'id' => 7,
        'meterTypeId' => 2,
        'meterTypeName' => 'Teplá voda',
        'meterNumber' => 12345,
        'startValue' => '100.500',
        'endValue' => '150.750',
        'startYearValue' => '90.000',
        'endYearValue' => '160.250',
    ]);

    expect($dto->id)->toBe(7)
        ->and($dto->meterTypeId)->toBe(2)
        ->and($dto->meterTypeName)->toBe('Teplá voda')
        ->and($dto->meterNumber)->toBe(12345)
        ->and($dto->startValue)->toBeInstanceOf(BigDecimal::class)
        ->and($dto->startValue->isEqualTo('100.500'))->toBeTrue()
        ->and($dto->endValue->isEqualTo('150.750'))->toBeTrue();
});

it('sets id to null for a new meter', function () {
    $dto = MeterData::fromArray([
        'meterTypeId' => 2,
        'meterTypeName' => 'Teplá voda',
        'meterNumber' => 12345,
        'startValue' => '0',
        'endValue' => '0',
        'startYearValue' => '0',
        'endYearValue' => '0',
    ]);

    expect($dto->id)->toBeNull();
});

