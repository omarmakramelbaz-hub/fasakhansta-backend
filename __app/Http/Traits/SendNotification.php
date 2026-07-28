<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Notification;
trait SendNotification {

    public function sendNotification($modelNotification =  [], $notifiable = [])
    {
        $admins = Admin::where('roles_name','["Super Admin"]')->get();

        foreach ($admins as $key => $value) {   
        
            Notification::send($value,new \App\Notifications\$modelNotification($notifiable));
        }
    }
}