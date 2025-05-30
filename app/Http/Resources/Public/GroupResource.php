<?php
namespace App\Http\Resources\Public;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'school' => $this->school->name,
            'languages' => GroupLanguageResource::collection($this->languages),
        ];
    }
}
