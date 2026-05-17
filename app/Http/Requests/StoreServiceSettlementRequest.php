<?php

namespace App\Http\Requests;

use App\Domains\ServiceSettlement\Validation\Validators\MeterDateConsistencyValidator;
use App\Enums\MeterType;
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

    public function prepareForValidation()
    {

        $this->merge([
            $this->flattenEntities(),
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

            'utility_hot_water' => data_get($this->input('utilities'), 'hotWater'),
            'utility_cold_water' => data_get($this->input('utilities'), 'coldWater'),
            'utility_heating' => data_get($this->input('utilities'), 'heating'),
            'utility_cold_water_for_hot' => data_get($this->input('utilities'), 'coldWaterForHot'),

        ];
    }

    private function presentedMeterTypes() : array
    {
        $meterTypes = collect($this->input('meters', []))->pluck('type');

        return [
            MeterType::HOT_WATER->value => $meterTypes->contains(MeterType::HOT_WATER->value),
            MeterType::COLD_WATER->value => $meterTypes->contains(MeterType::COLD_WATER->value),
            MeterType::HEATING->value => $meterTypes->contains(MeterType::HEATING->value),
        ];

    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
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
            'tenantOccupancyStartDate' => 'required|date|before:tenantOccupancyEndDate',
            'tenantOccupancyEndDate' => 'required|date',

            'coefficients' => 'nullable|array',

            'coefficients.oneCoefficient' => 'nullable|array',
            'coefficients.oneCoefficient.expensesCoefficient' => 'nullable|numeric|min:0|max:10',

            'coefficients.manyCoefficients' => 'nullable|array',
            'coefficients.manyCoefficients.*' => 'nullable|numeric|min:0|max:10',

            'hasMeters' => 'required|boolean',

            'meters' => 'present|array',
            'meters.*.id' => 'exclude_if:hasMeters,false|required',
            'meters.*.typeId' => ['exclude_if:hasMeters,false', 'required', Rule::enum(MeterType::class)],
            'meters.*.meterNumber' => 'exclude_if:hasMeters,false|nullable|string',
            'meters.*.startValue' => 'exclude_if:hasMeters,false|required|numeric|min:0',
            'meters.*.endValue' => 'exclude_if:hasMeters,false|required|numeric|min:0|gte:meters.*.startValue',
            'meters.*.startYearValue' => 'exclude_if:hasMeters,false|required|numeric|min:0',
            'meters.*.endYearValue' => 'exclude_if:hasMeters,false|required|numeric|min:0|gte:meters.*.startYearValue',

            'utilities' => 'present|array',
            'utility_hot_water' => [Rule::requiredIf($presentedMeterTypes[MeterType::HOT_WATER->value]), 'numeric', 'min:0'],
            'utility_cold_water' => [Rule::requiredIf($presentedMeterTypes[MeterType::COLD_WATER->value]), 'numeric', 'min:0'],
            'utility_heating' => [Rule::requiredIf($presentedMeterTypes[MeterType::HEATING->value]), 'numeric', 'min:0'],
            'utility_cold_water_for_hot' => 'nullable|numeric|min:0',



        ];
    }


    public function after()
    {
        return [
            function (Validator $validator) {

                app(MeterDateConsistencyValidator::class)->validate($validator, $this);

            }
        ];
    }

}
