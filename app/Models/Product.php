<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class Product extends Model implements HasMedia
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
    public function category() {
       return $this->belongsTo(\App\Models\Category::class,'category_id');
    }
    public function subcategory() {
       return $this->belongsTo(\App\Models\Category::class,'subcategory_id');
    }

    public function product_features() {
       return $this->hasMany(\App\Models\ProductFeature::class);
    }
    
}
