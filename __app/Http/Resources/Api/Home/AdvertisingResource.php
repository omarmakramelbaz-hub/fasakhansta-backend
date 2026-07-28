<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
class AdvertisingResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'resturant_id'       => $this->resturant_id,
            'resturant_name'     => $this->resturant?->name,
            'from_date'          => $this->from_date,
            'to_date'            => $this->to_date,
            'imgae'              => $this->getFirstMediaUrl('advertising_image','thumb'),
            'created_at'         => $this->created_at,
        ];
    }
}
