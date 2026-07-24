<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class UserAddressResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    =>$this->id,
            'area_name'             => $this->area_name,
            'mobile'                => $this->mobile,
            'apartment_no'          => $this->apartment_no,
            'floor_no'              => $this->floor_no,
            'street_name'           => $this->street_name,
            'badge'                 => $this->badge,
            'address_name'          => $this->address_name,
            'type'                  => $this->type,
            'lat'                   => $this->lat,
            'lng'                   => $this->lng,
            'country_name'          => $this->country_name,
            'city_name'             => $this->city_name,
            'address'               => $this->address,
            'city_id'             => $this->area_id,
            'cityname'             => $this->area?->title,

            'created_at'                   => $this->created_at,
        ];
    }
}