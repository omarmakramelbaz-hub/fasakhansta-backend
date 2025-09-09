<?php
namespace App\Http\Traits;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use App\Models\GeneralSettings;
trait FcmFirebase {

    public function sendFcmNotification($user_token= null , $data = [])
    {
                

        $fcm = $user_token;
        if (!$fcm) {
            return response()->json(['message' => 'User does not have a device token'], 400);
        }
         $setting=app(GeneralSettings::class); 
        $title = $data['title'];
        $description = $data['text'];
        $account_type = $data['data']['account_type'];
        $order_id = isset($data['data']['order_id'])?(string) $data['data']['order_id']:null;
        $notification_sound = isset($data['data']['notification_sound'])?(string) $data['data']['notification_sound']:'default';
        $notification_type = (string) $data['data']['notification_type'];
        $projectId = config('services.fcm.project_id'); # INSERT COPIED PROJECT ID

        $credentialsFilePath = public_path('firebase_credentials.json');
    //   dd($credentialsFilePath);
// dd($data['data']['account_type'],$data);
        $client = new GoogleClient();
        $client->setAuthConfig($credentialsFilePath);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        $client->refreshTokenWithAssertion();
        $token = $client->getAccessToken();
        $sound ="default";
        $access_token = $token['access_token'];

        $headers = [
            "Authorization: Bearer $access_token",
            'Content-Type: application/json'
        ];
        // dd($data['data']['click_action']);
        if($data['data']['notification_type']=='1'){
            $action=env('APP_URL')."/admin/applies-orders/?modal=order".$data['data']['order_id'];
        }
        elseif (isset($data['data']['click_action']) && $data['data']['click_action']) {
            $action=$data['data']['click_action'];
        }
        else{
            $action=env('APP_URL')."/admin/dashboard";
        }
        
        $array=array_merge($data['data'],[  "click_action"=> $action,
                     "icon"=>url('/storage/').$setting->logo]);
        $data = [
            "message" => [
                "token" => $fcm,
                "notification" => [
                    "title" => $title,
                    "body" => $description,

                ],
                'android' => [
                    'notification' => [ 'sound' => 'default'  ,   "icon"=>url('/storage/').$setting->logo, ] ,
                    "data" => [
                        "click_action" => $action // Click action for Android
                    ]
                ],
                'apns' => [ 'payload' => [ 'aps' => [ 'sound' => 'default'  ,   "icon"=>url('/storage/').$setting->logo, ] ] ],
                "data" => array_map('strval', $array)
                
            ]
        ];
        $payload = json_encode($data);
      
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
        curl_setopt($ch, CURLOPT_VERBOSE, true); // Enable verbose output for debugging
        $response = curl_exec($ch);
        $err = curl_error($ch);
    //  dd($response,$data);
        curl_close($ch);

        if ($err) {
            return response()->json([
                'message' => 'Curl Error: ' . $err
            ], 500);
        } else {
            return response()->json([
                'message' => 'Notification has been sent',
                'response' => json_decode($response, true)
            ]);
        }
     }
}