<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\Api\Home\CouponWheelResource;
use App\Http\Resources\Api\Home\CouponSubscripeResource;
use  App\Http\Requests\Api\Home\SubscripeCouponRequest;
use App\Models\CouponWheel;
use App\Models\CouponSubscripe;
use Carbon\Carbon;
use App\Http\Resources\Api\Auth\UserDataResource;

class CouponWheelUpdated implements ShouldBroadcast
{
    public $CouponWheel;

    public function __construct($CouponWheel)
    {
        $this->CouponWheel = $CouponWheel;

    }

    public function broadcastOn()
    {
            return new Channel('coupon.wheel.updated');

    }

    public function broadcastAs()
    {
        return 'coupon.wheel.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        $deleted=CouponWheel::where('id',$this->CouponWheel->id)->first();
        if($deleted){
        $winner=CouponSubscripe::orderBy('created_at','desc')->where('status','winner')->first();
        $CouponWheel=$this->CouponWheel;
          $now=Carbon::now();
    $startDate = Carbon::parse($CouponWheel?->start_date);
    $endDate = Carbon::parse($CouponWheel?->end_date);
            if($CouponWheel && $CouponWheel->status=='show' && $now->greaterThanOrEqualTo($startDate) && $now->lessThanOrEqualTo($endDate)){
                $data = new CouponWheelResource($CouponWheel);
                return ['flag'=>'coupon','data'=>$data,'winner'=>null,'winner_data'=>null];
            }elseif($winner){
                 $coupon = new CouponWheelResource($winner->CouponWheel);
                 $data=new CouponSubscripeResource($winner);
                 return ['flag'=>'winner','data'=>$coupon,'winner'=>$winner->user_coupon_code,'winner_data'=>UserDataResource::make($winner->user)];
            }else{
                return [];
            }
        }else{
            return [];
        }
       
    }
}


?>