<?php

declare(strict_types=1);

use App\Domains\ServiceSettlement\Calculation\ExpensesCalculator;
use App\Domains\ServiceSettlement\Dto\ExpenseData;
use App\Domains\ServiceSettlement\Dto\Calculation\SingleExpenseResult;
use Brick\Money\Money;

// Adjust the constructor args to match your real ExpenseData DTO
function expense(string $amount, string $name = 'Test'): ExpenseData
{
    return new ExpenseData(
        id: null,
        typeId: 1,
        typeName: $name,
        amount: Money::of($amount, 'CZK'),
    );
}

it('calculates per-day and per-period amounts for two expenses', function () {
    $calc = new ExpensesCalculator();

    // 1799 / 366 = 4.9153 per day, × 121 days = 594.75
    // 2864 / 366 = 7.8251 per day, × 121 days = 946.84
    $result = $calc->calculate([
        expense('1799.00', 'El. energie'),
        expense('2864.00', 'Správa domu'),
    ], daysInYear: 366, occupancyPeriod: 121);

    expect($result)->toHaveCount(2)
        ->each->toBeInstanceOf(SingleExpenseResult::class);

    // first expense
    expect($result[0]->expenseType)->toBe('El. energie')
        ->and((string) $result[0]->annualAmount->getAmount())->toBe('1799.00')
        ->and((string) $result[0]->amountPerDay)->toBe('4.9153')
        ->and((string) $result[0]->amountPerPeriod->getAmount())->toBe('594.75');

    // second expense
    expect($result[1]->expenseType)->toBe('Správa domu')
        ->and((string) $result[1]->annualAmount->getAmount())->toBe('2864.00')
        ->and((string) $result[1]->amountPerDay)->toBe('7.8251')
        ->and((string) $result[1]->amountPerPeriod->getAmount())->toBe('946.84');
});
