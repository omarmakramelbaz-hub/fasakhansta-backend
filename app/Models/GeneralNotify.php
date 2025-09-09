<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Scopes\AdminScope;

class GeneralNotify extends Model
{
    use HasFactory;
    protected static function booted()
    {
        static::addGlobalScope(new AdminScope);
    }
protected $guarded = [];
    public function user() {
       return $this->belongsTo(\App\Models\User::class);
    }

}
