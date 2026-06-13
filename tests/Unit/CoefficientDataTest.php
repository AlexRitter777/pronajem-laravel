<?php

use App\Domains\ServiceSettlement\Dto\CoefficientData;
use App\Domains\ServiceSettlement\Enums\CoefficientMode;

it('builds in MANY mode with all coefficients', function () {
    $dto = CoefficientData::fromArray([
        'useManyCoefficients' => true,
        'expensesCoefficient' => '1.5',
        'hotWaterCoefficient' => '2.0',
        'heatingCoefficient' => '0.75',
        'hotWaterAndWasteCoefficient' => '1.25',
    ]);

    expect($dto->mode)->toBe(CoefficientMode::MANY)
        ->and($dto->expensesCoefficient->isEqualTo('1.5'))->toBeTrue()
        ->and($dto->hotWaterCoefficient->isEqualTo('2.0'))->toBeTrue()
        ->and($dto->heatingCoefficient->isEqualTo('0.75'))->toBeTrue()
        ->and($dto->hotWaterAndWasteCoefficient->isEqualTo('1.25'))->toBeTrue();
});

it('builds in ONE mode with only expenses coefficient, rest null', function () {
    $dto = CoefficientData::fromArray([
        'useOneCoefficient' => true,
        'expensesCoefficient' => '1.5',
    ]);

    expect($dto->mode)->toBe(CoefficientMode::ONE)
        ->and($dto->expensesCoefficient->isEqualTo('1.5'))->toBeTrue()
        ->and($dto->hotWaterCoefficient)->toBeNull()
        ->and($dto->heatingCoefficient)->toBeNull()
        ->and($dto->hotWaterAndWasteCoefficient)->toBeNull();
});
