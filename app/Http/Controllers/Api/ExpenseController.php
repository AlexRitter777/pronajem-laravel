<?php

namespace App\Http\Controllers\Api;

use App\Actions\Expense\StoreExpenseAction;
use App\Dto\Expense\ExpenseData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExpenseRequest;
use App\Http\Resources\ExpenseResource;
use App\Http\Resources\LightExpenseResource;
use Auth;

class ExpenseController extends Controller
{
    public function __invoke(){

        $expenses = Auth::user()->expenses()->get();

        return LightExpenseResource::collection($expenses);

    }

    public function index()
    {

    }

    public function store(StoreExpenseRequest $request, StoreExpenseAction $action)
    {
        $expense = $action->execute(new ExpenseData($request->validated()), request()->user());

        return new ExpenseResource($expense);

    }
}
