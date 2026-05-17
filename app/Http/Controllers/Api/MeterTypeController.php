<?php

namespace App\Http\Controllers\Api;

use App\Enums\MeterType;
use App\Http\Controllers\Controller;
use App\Http\Resources\LightMeterTypeResource;

class MeterTypeController extends Controller
{
    public function __invoke()
    {

        $meterTypes = MeterType::cases();

        return LightMeterTypeResource::collection($meterTypes);

    }
}
