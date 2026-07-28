<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class UserServiceResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                 => $this->id,
            'service_id'         => (int) $this->service_id,
            'service_title'      => $this->service?->title,
            'notes'              =>$this->notes,
            'user_mobile'        =>$this->user_mobile,
            'created_at'         => $this->created_at,
        ];
    }
}
