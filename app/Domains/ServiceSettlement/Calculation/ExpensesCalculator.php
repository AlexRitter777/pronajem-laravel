<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Calculation;

use App\Domains\ServiceSettlement\Dto\Calculation\SingleExpenseResult;
use App\Domains\ServiceSettlement\Dto\ExpenseData;
use Brick\Math\RoundingMode;
use Brick\Money\Money;

final class ExpensesCalculator
{

    /**
     * @param ExpenseData[] $expenses
     * @return SingleExpenseResult[]
     */
    public function calculate(array $expenses, int $daysInYear, int $occupancyPeriod) : array
    {

        $result = [];

        foreach ($expenses as $expense){

            $amountPerDay = $expense->amount->getAmount()
                ->dividedBy($daysInYear, 4, RoundingMode::HALF_UP);

            $amountPerPeriod = Money::of(
                $amountPerDay->multipliedBy($occupancyPeriod)
                    ->toScale(2, RoundingMode::HALF_UP), 'CZK'
            );

            $result[] = new SingleExpenseResult(
                expenseType: $expense->typeName,
                annualAmount: $expense->amount,
                amountPerDay: $amountPerDay,
                amountPerPeriod: $amountPerPeriod,
            );

        }

        return $result;
    }

}
