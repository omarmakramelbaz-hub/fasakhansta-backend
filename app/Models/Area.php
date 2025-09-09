<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function parent(){
      return $this->belongsTo(Area::class,'parent_id');
    }
    public function admin(){
      return $this->belongsTo(User::class,'added_by');
    }

    public function child(){
        return $this->hasMany(Area::class,'parent_id');
    }
      public function getTitleAttribute()
    {
        $lang =app()->getLocale();
        $column = "title_" . $lang;
        return $this->{$column};
    }
    
}
