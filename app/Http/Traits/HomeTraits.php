<?php

namespace App\Http\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Banner;
use App\Models\Area;
use App\Models\QuestionAnswer;
use App\Models\Slidear;
use App\Models\CouponSubscripe;
use Illuminate\Support\Str;
use App\Models\Resturant;
trait HomeTraits
{
    public function splashes_data(){
        return Banner::where('status','show')->get();
    }
 
    public function areas_data(){
        $areas = Area::query();
        if(! empty(request('parent_id'))){
            $areas = $areas->where('parent_id', request('parent_id'));
        }
        else{
            $areas = $areas->whereNull('parent_id');
        }
        return $areas->get();
    }  
    
    public function help_data(){
        return QuestionAnswer::get();
    }
    
    public function slidear_data()
    {
        if (request('lat') != null && request('lng') != null) {
            $latitude = request('lat');
            $longitude = request('lng');

            $city_name = getCityName($latitude, $longitude);
            $area = Area::where('title_ar', 'LIKE', '%' . $city_name . '%')->orWhere('title_en', 'LIKE', '%' . $city_name . '%')->first();

            $restaurantAreas = \App\Models\ResturantArea::whereNotNull('lat')
                ->whereNotNull('lng')
                ->whereNotNull('expected_delivery')
                ->get();

            $restaurantIds = $restaurantAreas->filter(function ($restaurantArea) use ($latitude, $longitude) {
                $distance = $this->calculateDistance(
                    $latitude,
                    $longitude,
                    $restaurantArea->lat,
                    $restaurantArea->lng
                );
                return $distance <= $restaurantArea->expected_delivery;
            })->pluck('resturant_id')->toArray();

            if ($area) {
                $areaRestaurantIds = \App\Models\ResturantArea::where('area_id', $area->id)->pluck('resturant_id')->toArray();
                $restaurantIds = array_unique(array_merge($restaurantIds, $areaRestaurantIds));
            }

            $sliders = Slidear::whereIn('restraunt_id', $restaurantIds)->orWhereNull('restraunt_id')->get();

            return $sliders;
        } else {
            $sliders = Slidear::whereNull('restraunt_id')->get();
            return $sliders;
        }
    }
    
    public function generateUniqueCode($length = 10)
    {
        do {
            $code = Str::upper(Str::random($length));
        } while (CouponSubscripe::where('user_coupon_code', $code)->exists());

        return $code;
    }
    
    private function calculateDistance($lat1, $lng1, $lat2, $lng2)
    {
        $earthRadius = 6371; // Earth's radius in kilometers

        $lat1 = deg2rad($lat1);
        $lng1 = deg2rad($lng1);
        $lat2 = deg2rad($lat2);
        $lng2 = deg2rad($lng2);

        $latDiff = $lat2 - $lat1;
        $lngDiff = $lng2 - $lng1;

        $a = sin($latDiff / 2) * sin($latDiff / 2) +
            cos($lat1) * cos($lat2) *
            sin($lngDiff / 2) * sin($lngDiff / 2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }
}