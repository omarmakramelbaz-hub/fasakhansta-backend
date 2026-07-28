<?php

namespace App\Events;

use App\Models\Order;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Queue\SerializesModels;

class OrderStatusUpdated implements ShouldBroadcastNow
{
    use InteractsWithSockets, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order->load('resturant');
    }

    public function broadcastOn()
    {
        // Private channel for order user
        return new Channel('order.' . $this->order->id);
    }

    public function broadcastAs()
    {
        return 'status-updated';
    }

    public function broadcastWith()
    {
        return [
            'order_id' => $this->order->id,
            'order_status' => $this->getStatus($this->order->status),
            'restaurant_name' => $this->order->resturant->name,
        ];
    }
    
    private function getStatus($status)
    {
        $data = [
            'pending' => 'Preparing',
            'shipped' => 'On the Way',
            'completed' => 'Delivered',
        ];
        return $data[$status] ?? 'Preparing';
    }
}
