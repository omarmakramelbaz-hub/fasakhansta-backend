<?php

namespace App\Http\Controllers\Api\V1\Home;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Home\ContactResource;
use App\Models\CouponWheel;
use App\Models\CouponSubscripe;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponses;
use App\Http\Traits\HomeTraits;
use Notification;
use App\Models\GeneralSettings;
use App\Http\Resources\Api\Home\CouponWheelResource;
use App\Http\Resources\Api\Home\CouponSubscripeResource;
use  App\Http\Requests\Api\Home\SubscripeCouponRequest;
use Carbon\Carbon;
use App\Http\Resources\Api\Auth\UserDataResource;
class CouponWheelController extends Controller {
  use ApiResponses;use HomeTraits;


  public function coupon_wheels() {
        
    $CouponWheel=CouponWheel::with('resturants')->whereDate('start_date','<=',now())->whereDate('end_date','>=',now())->first();
    $CouponWheelWinner=CouponWheel::whereDate('start_date','<=',now())->whereDate('end_date','<=',now())->latest()->where('status','show')->first();
    $now=Carbon::now();
    $startDate = Carbon::parse($CouponWheel?->start_date);
    $endDate = Carbon::parse($CouponWheel?->end_date);
    $winner=CouponSubscripe::orderBy('created_at','desc')->where('status','winner')->first();
    if($CouponWheel && $CouponWheel->status=='show' && $now->greaterThanOrEqualTo($startDate) && $now->lessThanOrEqualTo($endDate)){
        $data = new CouponWheelResource($CouponWheel);
        return $this->successResponse(['flag'=>'coupon','data'=>$data,'winner'=>null,'winner_data'=>null],__('api.success data'));
    }elseif($winner){
         $coupon = new CouponWheelResource($winner->CouponWheel);
         $data=new CouponSubscripeResource($winner);
         return $this->successResponse(['flag'=>'winner','data'=>$coupon,'winner'=>$winner->user_coupon_code,'winner_data'=>UserDataResource::make($winner->user)],__('api.success data'));
    }else{
        return $this->errorResponse(__('api.there is no coupon wheel'));
    }
  }
  
  public function coupon_subscripes(SubscripeCouponRequest $request){
      $CouponWheel=CouponWheel::find($request->coupon_wheel_id);
      $now=Carbon::now();
      $startDate = Carbon::parse($CouponWheel->start_date);
      $endDate = Carbon::parse($CouponWheel->end_date);
      if($CouponWheel->status=='show' && $now->greaterThanOrEqualTo($startDate) && $now->lessThanOrEqualTo($endDate)){
         
              $subscripe=CouponSubscripe::create([
                  'user_id'=>auth('api')->user()->id,
                  'user_coupon_code'=>$this->generateUniqueCode(),
                  'coupon_wheel_id'=>$CouponWheel->id,
                  ]);
          
          $coupon_data=CouponSubscripe::whereNull('status')->get();
          $data=CouponSubscripeResource::collection($coupon_data);
          return $this->successResponse($data,__('api.success data'));
      }else{
            return $this->errorResponse(__("api.can't subscribe"));
        }
  }
}