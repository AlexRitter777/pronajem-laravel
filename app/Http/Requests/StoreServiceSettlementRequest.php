<?php

namespace App\Http\Requests;

use App\Domains\ServiceSettlement\Validation\Validators\CoefficientModeValidator;
use App\Domains\ServiceSettlement\Validation\Validators\MeterDateConsistencyValidator;
use App\Enums\MeterType;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;


class StoreServiceSettlementRequest extends FormRequest
{

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation() : void
    {

        $this->merge(
            $this->flattenEntities(),
        );

        $this->merge([
            'payments' => $this->cleanPayments(),
        ]);

    }

    private function flattenEntities() : array
    {
        return [
            'landlord_id' => data_get($this->input('landlord'), 'id'),
            'landlord_name' => data_get($this->input('landlord'), 'name'),

            'tenant_id' => data_get($this->input('tenant'), 'id'),
            'tenant_name' => data_get($this->input('tenant'), 'name'),

            'property_id' => data_get($this->input('property'), 'id'),
            'property_address' => data_get($this->input('property'), 'address'),

            'useOneCoefficient' => data_get($this->input('coefficients'), 'useOneCoefficient'),
            'useManyCoefficients' => data_get($this->input('coefficients'), 'useManyCoefficients'),
            'coefficients' =>data_get($this->input('coefficients'), 'values'),

            'utility_hot_water' => data_get($this->input('utilities'), 'hotWater'),
            'utility_cold_water' => data_get($this->input('utilities'), 'coldWater'),
            'utility_heating' => data_get($this->input('utilities'), 'heating'),
            'utility_cold_water_for_hot' => data_get($this->input('utilities'), 'coldWaterForHot'),

        ];
    }


    private function presentedMeterTypes() : array
    {
        $meterTypes = collect($this->input('meters', []))->pluck('typeId');
        return [
            MeterType::HOT_WATER->value => $meterTypes->contains(MeterType::HOT_WATER->value),
            MeterType::COLD_WATER->value => $meterTypes->contains(MeterType::COLD_WATER->value),
            MeterType::HEATING->value => $meterTypes->contains(MeterType::HEATING->value),
        ];

    }

    private function cleanPayments(): array
    {
        return collect($this->input('payments', []))
            ->reject(fn ($p) => $this->isEmptyPayment($p))
            ->values()
            ->all();
    }

        private function isEmptyPayment(array $payment): bool
    {
        return ($payment['amount'] ?? null) === null;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $presentedMeterTypes = $this->presentedMeterTypes();

        return [
            'landlord_id' => 'required|int|exists:landlords,id',
            'landlord_name' => 'required|string',

            'tenant_id' => 'required|int|exists:tenants,id',
            'tenant_name' => 'required|string',

            'property_id' => 'required|int|exists:properties,id',
            'property_address' => 'required|string',

            'invoicingYear' => 'required|int',
            'tenantOccupancyStartDate' => 'required|date',
            'tenantOccupancyEndDate' => 'required|date|after:tenantOccupancyStartDate',


            'useOneCoefficient' => 'required|boolean',
            'useManyCoefficients' => 'required|boolean',

            'coefficients' => 'present|array',
            'coefficients.expensesCoefficient' => [
                Rule::excludeIf(fn () =>
                    $this->input('useOneCoefficient') === false
                    && $this->input('useManyCoefficients') === false
                ),
                'required', 'numeric', 'gt:0', 'max:10' ,'decimal:0,2',
            ],
            'coefficients.hotWaterCoefficient' => 'exclude_if:useManyCoefficients,false|required|numeric|min:0|max:10',
            'coefficients.heatingCoefficient' => 'exclude_if:useManyCoefficients,false|required|numeric|min:0|max:10',
            'coefficients.coldWaterAndWasteCoefficient' => 'exclude_if:useManyCoefficients,false|required|numeric|min:0|max:10',

            'hasMeters' => 'required|boolean',
            'meters' => 'present|array',
            'meters.*.id' => 'exclude_if:hasMeters,false|required',
            'meters.*.typeId' => ['exclude_if:hasMeters,false', 'required', Rule::enum(MeterType::class)],
            'meters.*.typeName' => 'exclude_if:hasMeters,false|required|string',
            'meters.*.meterNumber' => 'exclude_if:hasMeters,false|required|string',
            'meters.*.startValue' => 'exclude_if:hasMeters,false|required|numeric|min:0|decimal:0,2',
            'meters.*.endValue' => 'exclude_if:hasMeters,false|required|numeric|min:0|gte:meters.*.startValue|decimal:0,3',

            'utility_hot_water' => ['exclude_if:hasMeters,true', 'nullable', 'numeric', 'gt:0', 'min:0', 'decimal:0,2'],
            'utility_cold_water' => ['exclude_if:hasMeters,true', 'nullable', 'numeric', 'gt:0', 'decimal:0,2'],
            'utility_heating' => ['exclude_if:hasMeters,true', 'nullable', 'numeric', 'gt:0', 'decimal:0,2'],
            'utility_cold_water_for_hot' => ['exclude_if:hasMeters,true', 'nullable', 'numeric', 'gt:0', 'decimal:0,2'],

//            'utility_hot_water' => [Rule::excludeIf(!$presentedMeterTypes[MeterType::HOT_WATER->value]), 'required', 'numeric', 'gt:0', 'min:0', 'decimal:0,2'],
//            'utility_cold_water' => [Rule::excludeIf(!$presentedMeterTypes[MeterType::COLD_WATER->value]), 'required', 'numeric', 'gt:0', 'decimal:0,2'],
//            'utility_heating' => [Rule::excludeIf(!$presentedMeterTypes[MeterType::HEATING->value]), 'required', 'numeric', 'gt:0', 'decimal:0,2'],
//            'utility_cold_water_for_hot' => [Rule::excludeIf(!$presentedMeterTypes[MeterType::HOT_WATER->value]), 'nullable', 'numeric', 'gt:0', 'decimal:0,2'],

            'expenses' => 'present|array',
            'expenses.*.id' => 'required',
            'expenses.*.expenseTypeId' => 'required|int|exists:expenses,id',
            'expenses.*.expenseTypeName' => 'required|string',
            'expenses.*.amount' => 'required|numeric|gt:0|decimal:0,2',

            'payments' => 'present|array',
            'payments.*.id' => 'nullable',
            'payments.*.month' => 'required_with:payments.*.amount|int|min:1|max:12',
            'payments.*.year' => 'required_with:payments.*.amount|nullable|int|digits:4',
            'payments.*.amount' => 'nullable|numeric|min:0|decimal:0,2',


        ];
    }


    public function after() : array
    {
        return [
            function (Validator $validator) {

                app(MeterDateConsistencyValidator::class)->validate($validator, $this);
                app(CoefficientModeValidator::class)->validate($validator, $this);

            }
        ];
    }

}
