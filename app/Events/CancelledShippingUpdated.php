<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\Api\ShippingResource;
use App\Http\Resources\Api\Auth\UserDataResource;

class CancelledShippingUpdated implements ShouldBroadcast
{
    public $order;
    public $senderId;

    public function __construct($order,$senderId)
    {
        $this->order = $order;
        $this->senderId = $senderId;
    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->senderId);
    }

    public function broadcastAs()
    {
        return 'cancelshipping.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        return [
            'order_id' => $this->order->id,
            'message' => 'order is cancelled!',
        ];
    }
}


?>