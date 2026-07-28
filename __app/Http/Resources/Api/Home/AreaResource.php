<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
class AreaResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id'                 => $this->id,
            'title'              => $this->title,
            'created_at'         => $this->created_at,
        ];
    }
}
