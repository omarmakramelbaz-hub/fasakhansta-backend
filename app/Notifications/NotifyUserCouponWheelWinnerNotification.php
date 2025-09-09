<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\CouponSubscripe;
use App\Http\Traits\FcmFirebase;

class NotifyUserCouponWheelWinnerNotification extends Notification
{
    use Queueable;
    use FcmFirebase;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(CouponSubscripe $msg)
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
        
        $this->body_data =[
                'title'     =>  'لديك إشعار خاص بمسابقة السحب',
                'text'      =>  'نتيجة السحب العشوائي لقد تم فوز صاحب الكوبون   '. $this->msg->user_coupon_code ,
                'created_at' => $this->msg->created_at,
                'data'       =>  [
                    'notification_type'     => 2,
                    'id'                    => $this->msg->id,
                    'user_coupon_code'      => $this->msg->user_coupon_code,
                    'user_id'               => $this->msg->user_id,
                    'account_type'=>$notifiable->account_type,

                ]
            ];    
            
         if($notifiable->device_token){
         $tokens= $notifiable->device_token ; 
          $this->sendFcmNotification( $tokens ,$this->body_data) ;
        }
        if($notifiable->fcm_id){
             $tokens= $notifiable->fcm_id ; 
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
