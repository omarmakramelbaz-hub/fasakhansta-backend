<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return[
            'id'=>$this->id,
            'conversational'=>auth('api')->user()->id==$this->user_id?$this->Userreciev->name:$this->UserSend->name,
            'conversational_id'=>auth('api')->user()->id==$this->user_id?$this->receiver:$this->user_id,
            'conversational_avatar'=>auth('api')->user()->id==$this->user_id?$this->Userreciev->getFirstMediaUrl('photo_profile','thumb'):$this->UserSend->getFirstMediaUrl('photo_profile','thumb'),
           
        ];
    }
}
