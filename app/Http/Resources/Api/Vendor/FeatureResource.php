<?php

namespace App\Http\Resources\Api\Vendor;

use Illuminate\Http\Resources\Json\JsonResource;

class FeatureResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                        => $this->id,
            'name'                      =>$this->name,
            'created_at'                => $this->created_at,
        ];
    }
}
