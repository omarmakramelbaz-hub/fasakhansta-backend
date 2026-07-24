<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\Api\User\OrderEventPusherResource;
use App\Models\Order;
class VendorUpdated implements ShouldBroadcast
{
    public $order;
    public $orderCount;
    public $senderId;

    public function __construct($order, $orderCount,$senderId)
    {
        if ($order instanceof Order) {
              $this->order = $order;
         }else{
             $this->order=Order::find($order);
         }
        $this->orderCount = $orderCount;
        $this->senderId = $senderId;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->senderId);

    }

    public function broadcastAs()
    {
        return 'vendor.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        return [
            'order_id' => OrderEventPusherResource::make($this->order),
            // 'username' => $this->order->user?->name,
            // 'message' => 'You have a new order!',
        ];
    }
}


?>