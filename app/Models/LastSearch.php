<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LastSearch extends Model
{
    use HasFactory;
    protected $guarded=[];
    
    public function resturant() {
       return $this->belongsTo(\App\Models\Resturant::class,'resturant_id');
    }
    
    
    public function is_user_searches(){
    //   if(auth('web')->check()){
         $search =  \App\Models\Resturant::where('resturant_id', $this->resturant_id)->count();
         dd($search);
         if(! $search){
            return false;
         }
         else{
            return true;
         }
    //   }
    }
    
}
