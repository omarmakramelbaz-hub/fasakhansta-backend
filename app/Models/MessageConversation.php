<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageConversation extends Model
{
    use HasFactory;
    protected $guarded=[];
    public function Sender(){
        return $this->belongsTo('App\Models\User','sender');
    }
    public function Reciever(){
        return $this->belongsTo('App\Models\User','reciever');
    }
}
