<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;

class Wishlist extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $guarded = [];
    public function resturant() {
       return $this->belongsTo(\App\Models\Resturant::class,'resturant_id');
    }
    
     public function user() {
       return $this->belongsTo(\App\Models\User::class,'user_id');
    }
}
