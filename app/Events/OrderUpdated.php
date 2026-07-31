<?php
namespace App\Events;

use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Models\Order;
class OrderUpdated implements ShouldBroadcastNow
{
    public $order;
    public $orderCount;
    public $senderId;
    public $action;

   public function __construct($order, $orderCount, $senderId, $action = 'new')
{
    if ($order instanceof Order) {
        $this->order = $order;
    } else {
        $this->order = Order::find($order);
    }

    $this->orderCount = $orderCount;
    $this->senderId = $senderId;
    $this->action = $action;
}
    
    public function broadcastOn()
{
    return new PrivateChannel('user.'.$this->senderId);
}
    public function broadcastAs()
    {
        return 'order.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        return [
            'order_id' => $this->order->id,
            'order_no' => $this->order->order_no,
            'order_date' => \Carbon\Carbon::parse($this->order->created_at)->format('d/m/Y'),
            'order_time' =>  \Carbon\Carbon::parse($this->order->created_at)->diffForHumans(),
            'orderCount' => $this->orderCount,
            'action' => $this->action,
            'message' => 'You have a new order!',
        ];
    }
}


?>
