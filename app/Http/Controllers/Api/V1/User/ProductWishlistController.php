<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Vendor\ResturantProductResource;
use App\Models\ResturantProduct;
use App\Models\Wishlist;
use App\Http\Traits\ApiResponses;
use Illuminate\Http\Request;

class ProductWishlistController extends Controller
{
    use ApiResponses;

    public function index()
    {
        $items = Wishlist::query()
            ->where('user_id', auth('api')->id())
            ->whereNotNull('resturant_product_id')
            ->with('resturantProduct')
            ->latest()
            ->get()
            ->pluck('resturantProduct')
            ->filter();

        return $this->successResponse(
            ResturantProductResource::collection($items->values()),
            'تم جلب المنتجات المفضلة'
        );
    }

    public function toggle(ResturantProduct $resturantProduct)
    {
        $wishlist = Wishlist::query()
            ->where('user_id', auth('api')->id())
            ->where('resturant_product_id', $resturantProduct->id)
            ->first();

        if ($wishlist) {
            $wishlist->delete();
            return $this->successResponse(['is_favorite' => false], 'تم حذف المنتج من المفضلة');
        }

        Wishlist::create([
            'user_id' => auth('api')->id(),
            'resturant_product_id' => $resturantProduct->id,
        ]);

        return $this->successResponse(['is_favorite' => true], 'تمت إضافة المنتج إلى المفضلة');
    }
}
