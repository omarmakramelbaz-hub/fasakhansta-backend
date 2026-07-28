<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\Vendor\ResturantProductResource;
class ProductCategoryResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'category_id'           => (int) $this[0]?->product?->category_id,
            'category_name'         => $this[0]?->product?->category?->name,
            'subcategory_id'        => (int) $this[0]?->product?->subcategory_id,
            'subcategory_name'      => $this[0]?->product?->subcategory?->name,
            'resturant_items'           => ResturantProductResource::collection($this),
        ];
    }
}
