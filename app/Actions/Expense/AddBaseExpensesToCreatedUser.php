<?php

namespace App\Actions\Expense;

use App\Models\Expense;
use App\Models\User;

final readonly class AddBaseExpensesToCreatedUser
{
    public function execute(User $user)
    {

        $expenses = config('default_expenses');

        foreach ($expenses as $expense){
            Expense::create([
                'user_id' => $user->id,
                'name' => $expense['name'],
            ]);
        }

    }
}
