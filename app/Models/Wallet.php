<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Wallet extends Model 
{
    use HasFactory;

    protected $guarded = [];

     public function from() {
       return $this->belongsTo(\App\Models\User::class,'from_user');
    }
    public function to() {
       return $this->belongsTo(\App\Models\User::class,'to_user');
    }
    
    public function order() {
       return $this->hasOne(\App\Models\Order::class,'wallet_id');
    }
    
    
    
    public function cart_order() {
       return $this->belongsTo(\App\Models\Order::class,'order_id');
    }
}
