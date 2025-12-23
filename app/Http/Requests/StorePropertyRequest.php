<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePropertyRequest extends FormRequest
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
            'address' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'description' => 'nullable|string|max:500',
            'rent_amount' => 'nullable|integer|min:0',
            'service_charge' => 'nullable|integer|min:0',
            'electricity_charge' => 'nullable|integer|min:0',
            'deposit_amount' => 'nullable|integer|min:0',
            'contract_finished_at' => 'nullable|date',
            'landlord_name' => 'nullable|string|max:255',
            'landlord_id' => 'nullable|exists:App\Models\Landlord,id',
            'tenant_name' => 'nullable|string|max:255',
            'tenant_id' => 'nullable|exists:App\Models\Tenant,id',
            'building_manager_name' => 'nullable|string|max:255',
            'building_manager_id' => 'nullable|exists:App\Models\BuildingManager,id',
            'electricity_supplier_name' => 'nullable|string|max:255',
            'electricity_supplier_id' => 'nullable|exists:App\Models\ElectricitySupplier,id',
        ];
    }
}
