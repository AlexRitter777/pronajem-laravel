<?php

namespace App\Actions\Property;

use App\Actions\Base\StoreUserOwnedModelAction;
use App\Models\Property;

final class StorePropertyAction extends StoreUserOwnedModelAction
{

    protected function model() : string
    {
        return Property::class;
    }

    protected function toArray(object $data): array
    {
        return [
            'address' => $data->address,
            'type' => $data->type,
            'description' => $data->description,
            'rent_amount' => $data->rent_amount,
            'service_charge' => $data->service_charge,
            'electricity_charge' => $data->electricity_charge,
            'deposit_amount' => $data->deposit_amount,
            'contract_finished_at' => $data->contract_finished_at,
            'landlord_id' => $data->landlord_id,
            'tenant_id' => $data->tenant_id,
            'building_manager_id' => $data->building_manager_id,
            'electricity_supplier_id' => $data->electricity_supplier_id,
        ];

    }

}
