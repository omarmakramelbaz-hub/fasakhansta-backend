<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
class CouponWheel extends Model implements HasMedia
{
    use HasFactory; use InteractsWithMedia;

    protected $guarded = [];
    
    public function resturants(){
        return $this->hasMany(CouponWheelResturant::class,'coupon_wheel_id');
    }
    
    public function subscripes(){
       return $this->hasMany(CouponSubscripe::class,'coupon_wheel_id'); 
    }
     public function orders(){
       return $this->hasMany(Order::class,'coupon_wheel_id'); 
    }
}
