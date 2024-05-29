<?php
namespace App\Http\Resources\Public;

use Illuminate\Http\Resources\Json\JsonResource;

class GroupLanguageResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->language->name,
            'scoolList' => optional($this->schoolList)->path,
        ];
    }
}
