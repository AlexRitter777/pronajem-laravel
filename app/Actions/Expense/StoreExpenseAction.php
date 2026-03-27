<?php

namespace App\Actions\Expense;

use App\Actions\Base\StoreUserOwnedModelAction;
use App\Models\Expense;

class StoreExpenseAction extends  StoreUserOwnedModelAction
{

    protected function model(): string
    {
        return Expense::class;
    }

    protected function toArray(object $data): array
    {
        return [
            'name' => $data->name,
        ];
    }

}
