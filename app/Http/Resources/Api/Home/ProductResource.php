<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Gate;
class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'                    => $this->id,
            'name'                  => $this->name_ar,
            'category_id'           => (int) $this->category_id,
            'category_name'         => $this->category?->name,
            'subcategory_id'        => (int) $this->subcategory_id,
            'subcategory_name'      => $this->subcategory?->name,
            'status'                => $this->status,
            'has_clean'                => $this->has_clean,
            'product_features'      => ProductFeatureResource::collection($this->product_features),
            'created_at'            => $this->created_at,
        ];
    }
}
