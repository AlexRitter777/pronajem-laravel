<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'type'  => $this->type,
            'address' => $this->address,
            'tenant' => $this->tenant,
            'contract_finished_at' => $this->contract_finished_at?->format('d.m.Y'),
            'rent_amount' => $this->rent_amount,
            'service_charge' => $this->service_charge,
            'electricity_charge' => $this->electricity_charge,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
