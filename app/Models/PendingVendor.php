<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use App\Scopes\AdminScope;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
class PendingVendor extends Model implements HasMedia
{
    use HasFactory;use InteractsWithMedia;

    protected $guarded = [];
    //  protected static function booted()
    // {
    //     static::addGlobalScope(new AdminScope);
    // }

    public function admin() {
       return $this->belongsTo(\App\Models\User::class,'added_by');
    }

    
}