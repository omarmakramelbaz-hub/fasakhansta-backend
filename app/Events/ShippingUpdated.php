<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\Api\ShippingResource;

class ShippingUpdated implements ShouldBroadcast
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
        return 'shipping.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        return [
            'order_id' => ShippingResource::make($this->order),
            // 'username' => $this->order->user?->name,
            // 'message' => 'You have a new order!',
        ];
    }
}


?>