<?php

namespace App\Services;

use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;

class FirebaseNotificationService
{
    protected $messaging;

    public function __construct()
    {
        $this->messaging = app('firebase.messaging');
    }

    public function sendNotification($token, $title, $body)
    {
        $message = CloudMessage::withTarget($token)
            ->withNotification(Notification::create($title, $body));

        $this->messaging->send($message);
    }
}
