<?php

use App\Domains\ServiceSettlement\Dto\HeatingCoefficientsData;

it('builds from a full array', function () {

    $dto = HeatingCoefficientsData::fromArray([
        'firstCoefficient' => '1.5',
        'secondCoefficient' => '0.35',
        'thirdCoefficient' => '0.15',

    ]);

    expect($dto->firstCoefficient->isEqualTo('1.5'))->toBeTrue()
        ->and($dto->secondCoefficient->isEqualTo('0.35'))->toBeTrue()
        ->and($dto->thirdCoefficient->isEqualTo('0.15'))->toBeTrue();

});

it('builds with null coefficients', function () {
    $dto = HeatingCoefficientsData::fromArray([]);

    expect($dto->firstCoefficient)->toBeNull()
        ->and($dto->secondCoefficient)->toBeNull()
        ->and($dto->thirdCoefficient)->toBeNull();
});

it('builds with one coefficient', function () {
    $dto = HeatingCoefficientsData::fromArray([
        'firstCoefficient' => '1.5',
    ]);
    expect($dto->firstCoefficient->isEqualTo('1.5'))->toBeTrue()
        ->and($dto->secondCoefficient)->toBeNull()
        ->and($dto->thirdCoefficient)->toBeNull();
});


