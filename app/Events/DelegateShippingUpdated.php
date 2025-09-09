<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\Api\ShippingResource;
use App\Http\Resources\Api\Auth\UserDataResource;

class DelegateShippingUpdated implements ShouldBroadcast
{
    public $order;
    public $orderCount;
    public $senderId;
    public $amount;

    public function __construct($order, $orderCount,$senderId,$amount)
    {
        $this->order = $order;
        $this->orderCount = $orderCount;
        $this->senderId = $senderId;
        $this->amount = $amount;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->senderId);

    }

    public function broadcastAs()
    {
        return 'delegateshipping.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        $userArray = (new UserDataResource($this->order))->toArray(request());
       $userArray['amount'] = $this->amount;

        return [
            'order_id' => $userArray,
            // 'username' => $this->order->user?->name,
            // 'message' => 'You have a new order!',
        ];
    }
}


?>