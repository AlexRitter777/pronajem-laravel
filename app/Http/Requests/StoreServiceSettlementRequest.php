<?php

namespace App\Http\Requests;

use App\Enums\MeterType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;


class StoreServiceSettlementRequest extends FormRequest
{

    private array $presentedMeterTypes = [
        MeterType::HOT_WATER->value => false,
        MeterType::COLD_WATER->value => false,
        MeterType::HEATING->value => false,
    ];
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function prepareForValidation()
    {

        $utilities = $this->input('utilities');

        if(!$utilities) return;

        $this->merge([
            'utility_hot_water' => $utilities['hotWater'] ?? null,
            'utility_cold_water' => $utilities['coldWater'] ?? null,
            'utility_heating' => $utilities['heating'] ?? null,
            'utility_cold_water_for_hot' => $utilities['coldWaterForHot'] ?? null,
        ]);


        if(!$this->boolean('has_meters')) return;

        $meterTypes = collect($this->input('meters', []))->pluck('type');

        foreach (MeterType::cases() as $type) {
            $this->presentedMeterTypes[$type->value] = $meterTypes->contains($type->value);
        }


    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'landlord' => 'required|array',
            'landlord.id' => 'required|int|exists:landlords,id',
            'landlord.name' => 'required|string',

            'tenant' => 'required|array',
            'tenant.id' => 'required|int|exists:landlords,id',
            'tenant.name' => 'required|string',

            'property' => 'required|array',
            'property.id' => 'required|int|exists:properties,id',
            'property.address' => 'required|string',

            'invoicingYear' => 'required|int',
            'tenantOccupancyStartDate' => 'required|date|before:tenantOccupancyEndDate',
            'tenantOccupancyEndDate' => 'required|date',

            'coefficients' => 'nullable|array',

            'coefficients.oneCoefficient' => 'nullable|array',
            'coefficients.oneCoefficient.expensesCoefficient' => 'nullable|numeric|min:0|max:10',

            'coefficients.manyCoefficients' => 'nullable|array',
            'coefficients.manyCoefficients.*' => 'nullable|numeric|min:0|max:10',

            'has_meters' => 'required|boolean',
            'meters' => 'present|array',
            'meters.*.id' => 'exclude_if:has_meters,false|required',
            'meters.*.type' => ['exclude_if:has_meters,false', 'required', Rule::enum(MeterType::class)],
            'meters.*.startValue' => 'exclude_if:has_meters,false|required|numeric|min:0',
            'meters.*.endValue' => 'exclude_if:has_meters,false|required|numeric|min:0|gte:meters.*.startValue',
            'meters.*.startYearValue' => 'exclude_if:has_meters,false|required|numeric|min:0',
            'meters.*.endYearValue' => 'exclude_if:has_meters,false|required|numeric|min:0|gte:meters.*.startYearValue',

            'utilities' => 'present|array',
            'utility_hot_water' => [Rule::requiredIf($this->presentedMeterTypes[MeterType::HOT_WATER->value]), 'numeric', 'min:0'],
            'utility_cold_water' => [Rule::requiredIf($this->presentedMeterTypes[MeterType::COLD_WATER->value]), 'numeric', 'min:0'],
            'utility_heating' => [Rule::requiredIf($this->presentedMeterTypes[MeterType::HEATING->value]), 'numeric', 'min:0'],
            'utility_cold_water_for_hot' => 'nullable|numeric|min:0',

            // change meters component vue
            // test


        ];
    }

    public function messages()
    {
        //
    }

    public function after()
    {
        return [
            function (Validator $validator) {

                $startOccupancyDate = $this->input('tenantOccupancyStartDate');
                $endOccupancyDate = $this->input('tenantOccupancyEndDate');

                if (!$startOccupancyDate || !$endOccupancyDate) {
                    return;
                }

                $hasMeters = $this->boolean('has_meters');

                $isActuallyFullYear = str_ends_with($startOccupancyDate, '-01-01')
                    && str_ends_with($endOccupancyDate, '-12-31');

                if (!$hasMeters && !$isActuallyFullYear) {
                    $validator->errors()->add('has_meters', 'Something is wrong with the dates. Please refresh the page and try again.');
                }
            }
        ];
    }

}
