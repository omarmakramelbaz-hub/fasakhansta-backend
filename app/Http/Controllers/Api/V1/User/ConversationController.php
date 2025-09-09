<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\User\ConversationMessagesResource;
use App\Http\Resources\Api\User\ConversationResource;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponses;
use App\Models\Conversation;
use App\Models\MessageConversation;
use App\Models\User;

class ConversationController extends Controller
{ 
    use ApiResponses;
    
    //

  

    public function conversations(){
        $conversations=Conversation::where('user_id',auth()->guard('api')->user()->id)->orWhere('receiver',auth()->guard('api')->user()->id)->get();
        $data = ConversationResource::collection($conversations);    
        return $this->successResponse($data,trans('messages.success data'));
    }
    public function conversation($id){
        $conversation=Conversation::find($id);
        foreach($conversation->msgs->where('reciever',auth('api')->user()->id) as $msg){
            $msg->update(['read'=>1]);
        }
        $data =ConversationMessagesResource::collection($conversation->msgs);    
        return $this->successResponse($data,trans('messages.success data'));
    }
    public function send_message(Request $request){
        MessageConversation::create([
            'conv_id'=>$request->conv_id,
            'sender'=>auth('api')->user()->id,
            'reciever'=>$request['receiver'],
            'message'=>$request['message'],
        ]);
        $conversation=Conversation::find($request->conv_id);
        $data =ConversationMessagesResource::collection($conversation->msgs);    
        return $this->successResponse($data,trans('messages.success data'));
    }
    public function new_conv($user_id){
    
      $conv= Conversation::Where('user_id',auth('api')->user()->id)->where('receiver',$user_id)->first();
    
       if($conv==null){
           $conv=Conversation::Where('receiver',auth('api')->user()->id)->where('user_id',$user_id)->first();
       }
      
          if($conv==null){
                $conv= Conversation::create(['user_id'=>auth('api')->user()->id,'receiver'=>$user_id]);;
          }
       $msgs=$conv->msgs;
       if($msgs){
       foreach($msgs->where('reciever',auth('api')->user()->id) as $msg){
           $msg->update(['read'=>1]);
       }
       }
       $data =new ConversationResource($conv);    
       return $this->successResponse($data,trans('messages.success data'));
    }
    
  
    
 
}
