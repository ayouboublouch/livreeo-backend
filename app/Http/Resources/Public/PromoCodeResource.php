<?php

namespace App\Http\Resources\Public;

use Illuminate\Http\Resources\Json\JsonResource;

class PromoCodeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'available_from' => $this->available_from,
            'available_to' => $this->available_to,
            'code' => $this->code,
            'reduction_rate' => $this->reduction_rate,
        ];
    }
}
