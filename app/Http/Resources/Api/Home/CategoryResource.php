<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Gate;
class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name,
            'parent_id'             => (int) $this->parent_id,
            'parent_name'           => $this->parent?->name,
            'resturant_products_count' => $this->resturant_products_count,
            'created_at'            => $this->created_at,
        ];
    }
}
