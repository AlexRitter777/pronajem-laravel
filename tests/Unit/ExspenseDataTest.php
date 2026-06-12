<?php

use App\Domains\ServiceSettlement\Dto\ExpenseData;

it('builds from a full array', function () {
    $dto = ExpenseData::fromArray([
        'id' => 5,
        'expenseTypeId' => 2,
        'expenseTypeName' => 'Opravy',
        'amount' => '1500.00',
    ]);

    expect($dto->id)->toBe(5)
        ->and($dto->typeId)->toBe(2)
        ->and($dto->typeName)->toBe('Opravy')
        ->and($dto->amount->getAmount()->__toString())->toBe('1500.00');
});

it('sets id to null for new expense', function () {
    $dto = ExpenseData::fromArray([
        'expenseTypeId' => 2,
        'expenseTypeName' => 'Opravy',
        'amount' => '1500.00',
    ]);

    expect($dto->id)->toBeNull();
});
