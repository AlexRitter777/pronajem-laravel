<?php

namespace App\Dto\Expense;

use Illuminate\Support\Arr;

readonly class ExpenseData
{

    public string $name;


    public function __construct(public array $data){

        $this->name = Arr::get($data, 'name');

    }

}
