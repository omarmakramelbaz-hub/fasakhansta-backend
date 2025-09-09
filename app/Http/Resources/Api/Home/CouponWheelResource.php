<?php

namespace App\Http\Resources\Api\Home;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Api\ResturantResource;
use App\Models\Area;
// use App\Models\CouponWheelResturant;

class CouponWheelResource extends JsonResource
{
    public function toArray($request)
    {
        $latitude = $request->input('lat');
        $longitude = $request->input('lng');

        return [
            'id'                => $this->id,
            'name'              => $this->name,
            'price'             => $this->price,
            'start_date'        => $this->start_date,
            'end_date'          => $this->end_date,
            'status'            => $this->status,
            'image'             => $this->getFirstMediaUrl('coupon_wheel_image', 'thumb'),
            'resturants'        => CouponWheelResturant::collection(
                $this->resturants()->whereHas('resturant', function ($query) use ($latitude, $longitude) {
                    if (!empty($latitude) && !empty($longitude)) {
                        $city_name = getCityName($latitude, $longitude);
                        $area = Area::where('title_ar', 'LIKE', '%' . $city_name . '%')
                            ->orWhere('title_en', 'LIKE', '%' . $city_name . '%')
                            ->first();

                        if ($area) {
                            $query->whereHas('resturant_areas', function ($subQuery) use ($area) {
                                    $subQuery->where('area_id', $area->id);
                                });
                        }
                    }
                })->get()
            ),
            'created_at'        => $this->created_at,
        ];
    }
}
