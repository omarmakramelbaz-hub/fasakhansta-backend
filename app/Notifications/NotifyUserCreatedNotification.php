<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Http\Traits\FcmFirebase;

class NotifyUserCreatedNotification extends Notification
{
    use Queueable;use FcmFirebase;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(User $msg)
    {
        $this->msg=$msg;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
       $this->body_data= [
                'title'     =>  'لديك إشعار عن إضافة '.__('main.'.$this->msg->account_type). ' جديد ',
                'text'      =>  'تم إنشاء حساب بإسم  ' . $this->msg->name,
                'redirect' => 'users/'.$this->msg->id.'?account_type=user',
                'data'      => [ 
                    'notification_type'=>7,
                    'user_id'  => $this->msg->id,
                    'name'     => $this->msg->name,
                    'account_type'=>$notifiable->account_type,
                  'notification_sound' => 'default',
                    ],
                'created_at' => $this->msg->created_at,
            ];   
            
            
        // if($notifiable->device_token){
        //  $tokens= $notifiable->device_token ; 
        //   $this->sendFcmNotification( $tokens ,$this->body_data) ;
        // }
        // if($notifiable->fcm_id){
        //      $tokens= $notifiable->fcm_id ; 
        //       $this->sendFcmNotification( $tokens ,$this->body_data) ;
        // }

        if($notifiable->my_tokens){
            $tokens= $notifiable->my_tokens ; 
            $this->sendFcmNotification( $tokens ,$this->body_data) ;
        }
        return $this->body_data;  
        
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
