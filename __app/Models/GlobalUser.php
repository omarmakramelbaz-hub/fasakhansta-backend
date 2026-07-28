<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;
use App\Enums\CategoryTypeEnum;
use Spatie\Permission\Traits\HasRoles;
use App\Scopes\AdminScope;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class GlobalUser extends User{

	 protected static function booted()
    {
        static::addGlobalScope(new AdminScope);
    }


}