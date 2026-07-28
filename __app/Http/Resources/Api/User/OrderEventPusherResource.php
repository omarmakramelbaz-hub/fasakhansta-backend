<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Auth\UserAddressResource;
class OrderEventPusherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
     
      protected $orders_count;

   
    public function getOrdersCount($orders_count)
    {
        $this->orders_count = $orders_count;
        return $this;
    }
    
    public function toArray($request)
    {
        return [
            'id'                        =>$this->id,
            'order_no'                  => $this->order_no,
            'status'                    => $this->status,

        ];
    }
}
