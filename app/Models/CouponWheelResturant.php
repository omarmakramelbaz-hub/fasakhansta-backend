<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponWheelResturant extends Model
{
    use HasFactory;

    protected $guarded = [];
    
    public function resturant(){
        return $this->belongsTo(Resturant::class,'resturant_id');
    }
}
