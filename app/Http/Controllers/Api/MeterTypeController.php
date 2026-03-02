<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\LightMeterTypeResource;
use App\Models\MeterType;
use Illuminate\Http\Request;

class MeterTypeController extends Controller
{
    public function __invoke()
    {

        $meterTypes = MeterType::all();

        return LightMeterTypeResource::collection($meterTypes);

    }
}
