<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
class Slidear extends Model implements HasMedia
{
    use HasFactory;use InteractsWithMedia;
    protected $guarded=[];
    public function admin() {
        return $this->belongsTo(User::class,'added_by');
     }
    public function restraunt() {
        return $this->belongsTo(Resturant::class,'restraunt_id');
     }
   
}
