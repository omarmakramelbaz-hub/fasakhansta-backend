<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;
use App\Models\GeneralSettings;

class DelegateNotification extends Model
{
    use HasFactory;
    protected $guarded = []; 
   
    public function delegate() {
       return $this->belongsTo(User::class,'delegate_id');
    }
    public function order() {
       return $this->belongsTo(Order::class,'order_id');
    }

}
