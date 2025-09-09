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
    
    public function slidear_data(){
        if(request('lat') != null && request('lng') != null){
            $city_name =getCityName(request('lat'), request('lng'));
         $latitude=request('lat');
        $longitude=request('lng');
    $area = Area::where('title_ar', 'LIKE', '%' . $city_name . '%')->orWhere('title_en', 'LIKE', '%' . $city_name . '%')->first();
    // dd($area);
    $resturant=Resturant::query();
      $resturant =$resturant->select(\DB::raw('*, ( 6367 * acos( cos( radians('.$latitude.') ) * cos( radians( lat ) ) * 
                      cos( radians( lng ) - radians('.$longitude.') ) + sin( radians('.$latitude.') ) * sin( radians( lat ) ) ) ) AS distance'))
                    ->having('distance', '<', 10000000)
                   ->orWhereHas('resturant_areas',function($q) use ($area){
                        $q->where('area_id' ,$area->id);
                    })->pluck('id')->toArray();
            $sliders= Slidear::whereIn('restraunt_id',$resturant)->orWhereNull('restraunt_id')->get();
    
            return $sliders;
            }
          else{
              $sliders= Slidear::whereNull('restraunt_id')->get();
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
}