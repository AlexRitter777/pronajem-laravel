<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceSettlementRequest;
use Illuminate\Http\Request;

class ServiceSettlementController extends Controller
{
    public function store(StoreServiceSettlementRequest $request)
    {
        dd($request->all());
    }
}
