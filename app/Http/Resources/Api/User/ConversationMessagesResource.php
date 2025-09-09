<?php

namespace App\Http\Resources\Api\User;

use Illuminate\Http\Resources\Json\JsonResource;

class ConversationMessagesResource extends JsonResource
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
            'conversation_id'=>$this->conv_id,
            'message'=>$this->message,
            'avatar'=>$this->Sender && $this->Sender->getFirstMediaUrl('photo_profile','thumb')?$this->Sender->getFirstMediaUrl('photo_profile','thumb'):url('site/images/avatar.png'),
            'read'=>$this->read,
            'created_at'=>$this->created_at,

        ];
    }
}
