<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
class CouponSubscripeResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id'                => $this->id,
            'price'             => $this->price,
            'user_coupon_code'  =>$this->user_coupon_code,
            'status'            => $this->status,
            'created_at'        => $this->created_at,
        ];
    }
}
