<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'customer_name' => $this->customer_name,
            'phone_number' => $this->phone_number,
            'booking_date' => $this->booking_date->format('Y-m-d H:i:s'),
            'booking_date_formatted' => $this->booking_date->format('d/m/Y H:i'),
            'service' => new ServiceResource($this->whenLoaded('service')),
            'notes' => $this->notes,
            'status' => $this->status,
            'created_by' => new UserResource($this->whenLoaded('createdBy')),
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'created_at_formatted' => $this->created_at->format('d/m/Y H:i'),
        ];
    }
}
