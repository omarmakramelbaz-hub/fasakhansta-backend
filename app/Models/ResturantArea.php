<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class ResturantArea extends Model 
{
    use HasFactory;

    protected $guarded = [];
    //  protected static function booted()
    // {
    //     static::addGlobalScope(new AdminScope);
    // }

    public function resturant() {
       return $this->belongsTo(\App\Models\Resturant::class,'resturant_id');
    }
    
     public function area() {
       return $this->belongsTo(\App\Models\Area::class,'area_id');
    }

    
}
