<?php

namespace App\Http\Resources\Public;

use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{

    const ARTICLE_TYPES = [
       1 => 'BOOK',
       2 => 'SUPPLY',
       3 => 'EXTRA',
    ];


    public function toArray($request)
    {

        if ($this->relationLoaded('groups') && $this->groups->isNotEmpty() && $this->groups[0]?->pivot?->quantity > 0) {
            $quantity = $this->groups[0]->pivot->quantity;
        }

        else if($this?->pivot?->order_id){

            if($this->pivot->quantity > 0) {
                $quantity = $this->pivot->quantity;
            } 

            if ($this?->pivot?->plastification ) {
                $plastification = $this->pivot->plastification;
            }
        }

        $data = [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'type' => self::ARTICLE_TYPES[$this->type],
            'price' => $this->price,
            'status' => $this->status,
            'category' => $this->category->name ?? null,
            'image_path' => $this->image->path ?? null,
            'variants' => $this->variants,
        ];

        if (isset($quantity) && $quantity !== null) {
            $data['quantity'] = $quantity;
        }

        if (isset($plastification) && $plastification !== null) {
            $data['plastification'] = $plastification;
        }

        return $data;
    }
}
