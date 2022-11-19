<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TripWithAvailableSeatsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'bus_id' => $this->bus_id,
            'created_at' => Carbon::parse($this->created_at)->format('Y-m-d'),

            'available_seats' => $this->available_seats->map(fn($seat) => [
                "id" => $seat->id,
                "number" => $seat->number,
                "bus_id" => $seat->bus_id,
            ]),

            'bus' => [
                "id" => $this->bus->id,
                "number" => $this->bus->number,
                'created_at' => Carbon::parse($this->bus->created_at)->format('Y-m-d'),
            ],
        ];
    }
}
