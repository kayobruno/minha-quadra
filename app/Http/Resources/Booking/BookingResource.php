<?php

declare(strict_types=1);

namespace App\Http\Resources\Booking;

use App\Http\Resources\Court\CourtResource;
use App\Http\Resources\Customer\CustomerResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookingResource extends JsonResource
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
            'start_datetime' => $this->start_datetime,
            'end_datetime' => $this->end_datetime,
            'total_hours' => $this->total_hours,
            'status' => $this->status,
            'court' => new CourtResource($this->court),
            'customer' => new CustomerResource($this->customer),
            'sport' => [
                'name' => $this->sport->label(),
                'icon' => $this->sport->icon(),
            ],
        ];
    }
}
