<?php

namespace App\Http\Controllers\Api;

use App\Domains\ServiceSettlement\Dto\ServiceSettlementData;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreServiceSettlementRequest;
use Illuminate\Http\Request;

class ServiceSettlementController extends Controller
{
    public function store(StoreServiceSettlementRequest $request)
    {

        $data = ServiceSettlementData::fromArray($request->validated());

        dd($data);

    }

}
