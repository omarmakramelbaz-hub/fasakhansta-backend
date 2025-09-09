<?php

namespace App\Http\Resources\Api\Auth;

use Illuminate\Http\Resources\Json\JsonResource;
use DB;

class UserDataResource extends JsonResource
{
    private $token = '';

    public function getToken($token)
    {
        $this->token = $token;
        return $this;
    }

    public function getPhotoProfile($photo_profile)
    {
        $this->photo_profile = $photo_profile;
        return $this;
    }

    public function toArray($request)
    {
        
       
        return [
            'id'                  => $this->id,
            'name'                => $this->name,
            'account_type'        => $this->account_type,
           
            'lat'                 => $this->lat,
            'lng'                 => $this->lng,
           
            'photo_profile'       => $this->getFirstMediaUrl('photo_profile','thumb'),
            'completed_orders_count'=>$this->delegate_orders()->where('status','completed')->count()
           

            ];
    }
}
