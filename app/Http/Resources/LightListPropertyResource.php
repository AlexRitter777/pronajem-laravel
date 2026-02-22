<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LightListPropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'address' => $this->address,
            'tenant' => $this->tenant ? $this->tenant->only('id', 'name') : null,
            'landlord' => $this->landlord ? $this->landlord->only('id', 'name') : null,
        ];
    }
}
