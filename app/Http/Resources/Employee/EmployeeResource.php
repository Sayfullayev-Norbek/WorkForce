<?php

namespace App\Http\Resources\Employee;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'              => $this->id,
            'passport_number' => $this->passport_number,
            'first_name'      => $this->first_name,
            'last_name'       => $this->last_name,
            'middle_name'     => $this->middle_name,
            'position'        => $this->position,
            'phone'           => $this->phone,
            'address'         => $this->address,
            'latitude'        => $this->latitude,
            'longitude'       => $this->longitude,
            'zoom_level'      => $this->zoom_level,
            'company_id'      => $this->company_id,
        ];
    }
}
