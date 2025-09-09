<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;

class SlidearResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'title'               => $this->title,
            'resturant_id'         => (int) $this->restraunt_id,
            'imgaes'=>ImageResource::collection($this->getMedia('slidear_image')),
            'created_at'         => $this->created_at,
        ];
    }
}
