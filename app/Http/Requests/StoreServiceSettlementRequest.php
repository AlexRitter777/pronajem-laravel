<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceSettlementRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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

            'meters' => 'required|array',
            'meters.*.id' => 'required|string', //??
            'meters.*.typeId' => 'required|int|exists:meter_types,id',
            'meters.*.typeName' => 'required|string',
            'meters.*.startValue' => 'required|numeric|min:0',
            'meters.*.endValue' => 'required|numeric|min:0',
            'meters.*.startYearValue' => 'required|numeric|min:0',
            'meters.*.endYearValue' => 'required|numeric|min:0',
        ];
    }
}
