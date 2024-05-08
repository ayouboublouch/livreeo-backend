<?php
namespace App\Http\Resources\Public;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tracking_number' => $this->tracking_number,
            'status' => $this->status,
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'address' => $this->address,
            'city' => $this->city,
            'comment' => $this->comment,
            'shipping_type' => $this->shippingType->title,
            'promo_code' => $this->promo_code,
            'reduction_rate' => $this->reduction_rate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'variants' => VariantResource::collection($this->variants),
            'total_price' => $this->totalPrice(),
        ];
    }
}
