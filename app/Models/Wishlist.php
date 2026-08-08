<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\HasMedia;

class Wishlist extends Model implements HasMedia
{
    use InteractsWithMedia;
    use HasFactory;

    protected $guarded = [];

    public function resturant()
    {
        return $this->belongsTo(Resturant::class, 'resturant_id');
    }

    public function resturantProduct()
    {
        return $this->belongsTo(ResturantProduct::class, 'resturant_product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
