<?php

namespace App\Domains\ServiceSettlement\Validation\Validators;

use App\Http\Requests\StoreServiceSettlementRequest;
use Illuminate\Validation\Validator;

final class CoefficientModeValidator
{
    public function validate(Validator $validator, StoreServiceSettlementRequest $request): void
    {
        $useOne = $request->boolean('useOneCoefficient');
        $useMany = $request->boolean('useManyCoefficients');

        if ($useOne && $useMany) {
            $validator->errors()->add('common_error', __('The form state is invalid. Please refresh the page and try again'));
        }
    }
}
