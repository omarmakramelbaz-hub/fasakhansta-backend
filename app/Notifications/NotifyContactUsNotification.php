<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Contact;
use App\Http\Traits\FcmFirebase;

class NotifyContactUsNotification extends Notification
{
    use Queueable;use FcmFirebase;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(Contact $msg)
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
          $tokens = [];
        $types  = [];
        
        $this->body_data=
       [
                'title'     =>  'لديك إشعار وجود رسالة جديدة ',
                'text'      =>  'تم إرسال رسالة من   ' . $this->msg->name,
                'redirect' => 'contacts/#td-'.$this->msg->id,
                'data'      => [ 
                    'id'  => $this->msg->id,
                    'name'     => $this->msg->name,
                    'account_type'=>$notifiable->account_type,
                    'notification_type' => 8,
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
