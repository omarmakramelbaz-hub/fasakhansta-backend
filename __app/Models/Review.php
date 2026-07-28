<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class Review extends Model 
{
    use HasFactory;

    protected $guarded = [];
    
    public function resturant() {
       return $this->belongsTo(Resturant::class,'resturant_id');
    }
 public function order() {
       return $this->belongsTo(Order::class,'order_id');
    }

    public function user() {
       return $this->belongsTo(User::class,'user_id');
    }

}
