<?php

use App\Domains\ServiceSettlement\Dto\PaymentData;
use Brick\Money\Money;


it('builds from a full array', function () {
    $dto = PaymentData::fromArray([
        'id' => 1,
        'month' => 3,
        'year' => 2025,
        'amount' => '10.99',
    ]);

    expect($dto->id)->toBe(1)
        ->and($dto->month)->toBe(3)
        ->and($dto->year)->toBe(2025)
        ->and($dto->amount)->toBeInstanceOf(Money::class)
        ->and($dto->amount->getCurrency()->getCurrencyCode())->toBe('CZK')
        ->and((string) $dto->amount->getAmount())->toBe('10.99');
});


it('casts a float amount to Money without losing precision', function () {
    $dto = PaymentData::fromArray([
        'id' => 1,
        'month' => 3,
        'year' => 2025,
        'amount' => 10.99,
    ]);

    expect($dto->amount)->toBeInstanceOf(Money::class)
        ->and((string) $dto->amount->getAmount())->toBe('10.99');
});



it('produces equal Money for string and float inputs of the same value', function () {

    $fromString = PaymentData::fromArray([
        'id' => 1,
        'month' => 3,
        'year' => 2025,
        'amount' => '250.00',
    ]);

    $fromFloat  = PaymentData::fromArray([
        'id' => 1,
        'month' => 3,
        'year' => 2025,
        'amount' => 250.0,

    ]);

    expect($fromString->amount->isEqualTo($fromFloat->amount))->toBeTrue();
});
