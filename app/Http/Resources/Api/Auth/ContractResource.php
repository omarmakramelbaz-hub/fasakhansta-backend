<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class ContractResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                  => $this->id,
            'template'            => $this->template,
         
        ];
    }
}