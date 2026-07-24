<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class Category extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $guarded = [];
     protected static function booted()
    {
        // static::addGlobalScope(new AdminScope);
    }
 public function getNameAttribute()
    {
        $lang = App::getLocale();
        $column = "name_" . $lang;
        return $this->{$column};
    }
  
    public function admin() {
       return $this->belongsTo(\App\Models\User::class,'added_by');
    }

    public function parent() {
       return $this->belongsTo(\App\Models\Category::class);
    }
    public function resturant_products() {
       return $this->hasMany(\App\Models\ResturantProduct::class,'category_id');
    }
    public function category_products() {
       return $this->hasMany(\App\Models\Product::class,'category_id');
    }
    
    public function subcategory_products() {
       return $this->hasMany(\App\Models\Product::class,'subcategory_id');
    }
    
    public function childs() {
       return $this->hasMany(\App\Models\Category::class,'parent_id');
    }
}
