<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewNotification implements ShouldBroadcast,ShouldQueue
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $id;
    public $email;

    public function __construct($result)
    {
        $this->id = $result['id'];
        $this->email = $result['email'];
    }

    public function broadcastOn()
    {
        return new Channel('new-notification');
    }

    // Optionally, broadcast the data to be sent with the event
    public function broadcastWith()
    {
        return [
            'id' => $this->id,
            'email' => $this->email,
        ];
    }public function broadcastAs()
    {
        return 'NewNotification';  // Ensure this matches what you're listening for on the frontend
    }

}
