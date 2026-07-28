<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
class SplasheResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id'                 => $this->id,
            'title'              => $this->title,
            'image'              => $this->getFirstMediaUrl('image','thumb'),
            'created_at'         => $this->created_at,
        ];
    }
}
