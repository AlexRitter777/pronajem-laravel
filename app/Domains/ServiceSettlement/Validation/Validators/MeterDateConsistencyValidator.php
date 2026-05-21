<?php

namespace App\Domains\ServiceSettlement\Validation\Validators;


use App\Http\Requests\StoreServiceSettlementRequest;
use Illuminate\Validation\Validator;

class MeterDateConsistencyValidator
{

    public function validate(Validator $validator, StoreServiceSettlementRequest $request) :void
    {

        $startOccupancyDate = $request->input('tenantOccupancyStartDate');
        $endOccupancyDate = $request->input('tenantOccupancyEndDate');

        if (!$startOccupancyDate || !$endOccupancyDate) {
            return;
        }

        $hasMeters = $request->boolean('hasMeters');

        $isActuallyFullYear = str_ends_with($startOccupancyDate, '-01-01')
            && str_ends_with($endOccupancyDate, '-12-31');

        if (!$hasMeters && !$isActuallyFullYear) {

            foreach ($validator->errors()->keys() as $key) {
                $validator->errors()->forget($key);
            }

            $validator->errors()->add('common_error', __('The form state is invalid. Please refresh the page and try again'));
        }

    }

}
