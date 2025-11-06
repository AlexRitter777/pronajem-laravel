<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LandlordResource extends JsonResource
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
            'name'  => $this->name,
            'address' => $this->address,
            'email' => $this->email,
            'phone' => $this->phone_number,
            'properties' => $this->properties,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
