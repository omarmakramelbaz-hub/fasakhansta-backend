<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class Cart extends Model
{
    use HasFactory;
    protected $guarded = []; 
   
  
    public function user() {
       return $this->belongsTo(\App\Models\User::class);
    }
     public function order() {
       return $this->belongsTo(\App\Models\Order::class);
    }
     public function resturant_product() {
       return $this->belongsTo(\App\Models\ResturantProduct::class);
    }
      public function resturant() {
       return $this->belongsTo(\App\Models\Resturant::class);
    }

    public function product_feature() {
       return $this->belongsTo(\App\Models\ProductFeature::class,'product_feature');
    }
    
    public function product_feature1() {
       return $this->belongsTo(\App\Models\ProductFeature::class,'product_feature');
    }

}
