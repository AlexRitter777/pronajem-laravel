<?php

use App\Domains\ServiceSettlement\Dto\MeterData;
use App\Enums\MeterType;
use Brick\Math\BigDecimal;

it('builds from a full array', function () {
    $dto = MeterData::fromArray([
        'id' => 7,
        'typeId' =>'hot_water',
        'typeName' => 'Teplá voda',
        'meterNumber' => 12345,
        'startValue' => '100.500',
        'endValue' => '150.750',
    ]);

    expect($dto->id)->toBe(7)
        ->and($dto->meterTypeId)->toBe(MeterType::HOT_WATER)
        ->and($dto->meterTypeName)->toBe('Teplá voda')
        ->and($dto->meterNumber)->toBe(12345)
        ->and($dto->startValue)->toBeInstanceOf(BigDecimal::class)
        ->and($dto->startValue->isEqualTo('100.500'))->toBeTrue()
        ->and($dto->endValue->isEqualTo('150.750'))->toBeTrue();
});

it('sets id to null for a new meter', function () {
    $dto = MeterData::fromArray([
        'typeId' => 'hot_water',
        'typeName' => 'Teplá voda',
        'meterNumber' => 12345,
        'startValue' => '0',
        'endValue' => '0',
    ]);

    expect($dto->id)->toBeNull();
});

