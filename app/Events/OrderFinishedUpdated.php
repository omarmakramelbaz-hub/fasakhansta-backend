<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class OrderFinishedUpdated implements ShouldBroadcast
{
    public $order;
    public $orderCount;
    public $senderId;

    public function __construct($order, $orderCount,$senderId)
    {
        $this->order = $order;
        $this->orderCount = $orderCount;
        $this->senderId = $senderId;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->senderId);

    }

    public function broadcastAs()
    {
        return 'finished.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        return [
            'order_id' => $this->order->id,
            'order_no' => $this->order->order_no,
            'username' => $this->order->user?->name,
            // 'message' => 'You have a new order!',
        ];
    }
}


?>