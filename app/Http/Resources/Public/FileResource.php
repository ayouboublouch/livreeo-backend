<?php
namespace App\Http\Resources\Public;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FileResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'path' => route('files', [
                'id' => $this->id,
            ]),
        ];
    }
}
