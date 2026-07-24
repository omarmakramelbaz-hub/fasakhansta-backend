<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;

class Banner extends Model implements HasMedia
{

    use HasFactory;
    use InteractsWithMedia;

    protected $guarded = [];
      public function getTitleAttribute()
    {
        $lang = App::getLocale();
        $column = "title_" . $lang;
        return $this->{$column};
    }
    
    public function admin() {
       return $this->belongsTo(\App\Models\User::class,'added_by');
    }
    
}
