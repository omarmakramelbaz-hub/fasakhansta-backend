<?php

namespace App\Http\Resources\Api\Service;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Gate;
class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        if(auth('api')->user()->account_type == 'user'){
            $gates = GateResource::collection($this->gates);
        }elseif(auth('api')->user()->account_type == 'valet'){
            $gate = Gate::findOrFail(auth('api')->user()->gate_id);
            $gates = GateResource::make($gate);
        }
        return [
            'id'                 => $this->id,
            'title'              => $this->title,
            'address'            => $this->address,
            'category_type_id'   => $this->category_type_id,
            'category_type_title'=> $this->category_type?->title,
            'gates'              => $gates,
            'created_at'         => $this->created_at,
        ];
    }
}
