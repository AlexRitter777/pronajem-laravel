<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LightExpenseResource;
use App\Models\User;
use Auth;

class ExpenseController extends Controller
{
    public function __invoke(){

        $expenses = Auth::user()->expenses()->get();

        return LightExpenseResource::collection($expenses);

    }
}
