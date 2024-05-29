<?php

namespace App\Http\Resources\Public;

use App\Http\Resources\Admin\CityResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'contract_type' => $this->contract_type,
            'city' => new CityResource($this->city),
        ];
    }
}
