<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;

class Shipping extends Model 
{
    use HasFactory;

    protected $guarded = [];

     public function user() {
       return $this->belongsTo(User::class,'user_id');
    }
    public function order() {
       return $this->belongsTo(Order::class,'to_user');
    }
    
    
}
