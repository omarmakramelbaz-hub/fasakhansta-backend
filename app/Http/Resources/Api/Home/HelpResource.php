<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
class HelpResource extends JsonResource
{
    public function toArray($request)
    {
        
        
        return [
            'id'                 => $this->id,
            'question'              => $this->question,
            'answer'              => $this->answer,
            'created_at'         => $this->created_at,
        ];
    }
}
