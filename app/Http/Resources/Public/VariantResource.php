<?php
namespace App\Http\Resources\Public;

use App\Models\OrderVariant;
use Illuminate\Http\Resources\Json\JsonResource;

class VariantResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'id' => $this->id,
            'color' => $this->color,
            'image' => $this->image ? new FileResource($this->image) : null,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'article' => (new ArticleResource($this->article))->makeHidden('variants'),
        ];
        
        if ($this->pivot instanceof OrderVariant) {
            $data['plastification'] = $this->pivot->plastification;
            $data['quantity'] = $this->pivot->quantity;
        }

        return $data;
    }
}
