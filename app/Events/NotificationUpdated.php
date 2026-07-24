<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationUpdated implements ShouldBroadcast
{
    public $data;
    public $orderCount;
    public $senderId;

    public function __construct($data,$senderId)
    {
        $this->data = $data;
        // $this->orderCount = $orderCount;
        $this->senderId = $senderId;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->senderId);

    }

    public function broadcastAs()
    {
        return 'notification.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        return [
            'data' => $this->data,
            'message' => 'You have a new notification!',
        ];
    }
}


?>