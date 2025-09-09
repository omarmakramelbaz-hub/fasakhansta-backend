<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class AboutResource extends JsonResource
{
    public function toArray($request)
    {
        
        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'description'      => $this->description,
            'created_at'       => $this->created_at,
        ];
    }
}
