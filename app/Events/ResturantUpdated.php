<?php
namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use App\Http\Resources\Api\Vendor\ResturantResource;
class ResturantUpdated implements ShouldBroadcast
{
    public $resturant;
    public $senderId;

    public function __construct($resturant,$senderId)
    {
        $this->resturant = $resturant;
        $this->senderId = $senderId;

    }

    public function broadcastOn()
    {
        // return new Channel('user.'.$this->senderId);
            return new Channel('resturant.updated');

    }

    public function broadcastAs()
    {
        return 'resturant.updated'; // Event name
    }
    
    public function broadcastWith()
    {
        return [
            'resturant' => ResturantResource::make($this->resturant),
            // 'username' => $this->resturant->user?->name,
            // 'message' => 'You have a new resturant!',
        ];
    }
}


?>