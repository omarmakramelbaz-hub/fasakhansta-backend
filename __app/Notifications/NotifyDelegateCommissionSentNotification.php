<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Commission;
use App\Http\Traits\FcmFirebase;

class NotifyDelegateCommissionSentNotification extends Notification
{
    use Queueable;
    use FcmFirebase;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    private $msg;
    public function __construct(Commission $msg)
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
                'title'     =>  'لديك إشعار جديد ',
                'logo'     => $this->msg->order?->resturant?->getFirstMediaUrl('logo','thumb'),
                'text'      =>  'تم إرسال إكرامية من قبل الطلب رقم   ' . $this->msg->order?->order_no . ' بقيمة '. $this->msg->commission .' ج.م',
                'created_at' => $this->msg->created_at,
                'data'      => [ 
                    'notification_type' => 1,
                    'order_id'          => (int) $this->msg->order_id,
                    'delegate_id'       => $this->msg->delegate_id,
                    'account_type'=>$notifiable->account_type,
                    'notification_sound' => 'default',

                    ],
            ];    
            
        // if($notifiable->is_notify == 'yes'){
        //     // foreach ($notifiable as $device) {
                // $tokens= $notifiable->fcm_id ; 
        //     // }
            // $this->sendFcmNotification( $tokens ,$this->body_data) ;
        // }
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
