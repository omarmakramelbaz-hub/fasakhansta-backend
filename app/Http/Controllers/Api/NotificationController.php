<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;

use App\Services\FirebaseNotificationService;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    protected $notificationService;

    public function __construct(FirebaseNotificationService $notificationService)
    {
        $this->notificationService = $notificationService;
    }

    public function send(Request $request)
    {
        $token = $request->token;
        $title = $request->title;
        $body = $request->body;
dd($token);
        $this->notificationService->sendNotification($token, $title, $body);

        return response()->json(['message' => 'Notification sent successfully.']);
    }
}
