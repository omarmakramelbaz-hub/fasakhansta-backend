<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class BalanceUpdated implements ShouldBroadcast
{
    public $user;
    public $senderId;

    public function __construct($user,$senderId)
    {
        $this->user = $user;
        // $this->orderCount = $orderCount;
        $this->senderId = $senderId;

    }

    public function broadcastOn()
    {
        return new PrivateChannel('user.'.$this->senderId);

    }

    public function broadcastAs()
    {
        return 'balance.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        return [
            'user_id' => $this->user?->id,
            'user_balance' => $this->user?->balance,
            'message' => 'You have an updated balance!',
        ];
    }
}


?>