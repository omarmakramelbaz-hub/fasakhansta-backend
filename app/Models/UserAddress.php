<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;

class UserAddress extends Model 
{
    use HasFactory;
    protected $table="user_address";
    protected $guarded = [];
   
    public function user() {
       return $this->belongsTo(User::class,'user_id');
    }
    public function area() {
       return $this->belongsTo(User::class,'area_id');
    }
    
    
}
