<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
class Advertising extends Model implements HasMedia
{
    use HasFactory;use InteractsWithMedia;
    protected $guarded=[];
    public function admin() {
        return $this->belongsTo(\App\Models\User::class,'added_by');
     }
    public function resturant() {
       return $this->belongsTo(\App\Models\Resturant::class);
    }
   
}
