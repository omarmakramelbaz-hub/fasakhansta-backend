<?php
namespace App\Http\Traits;

use Google\Client as GoogleClient;
use Illuminate\Support\Facades\Log;
use App\Models\GeneralSettings;
use Kreait\Firebase\Contract\Messaging;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Kreait\Firebase\Messaging\AndroidConfig;
use Kreait\Firebase\Messaging\ApnsConfig;
use Kreait\Firebase\Factory;

trait FcmFirebase {

    /**
     * Use the configured private Firebase service-account file.
     * The old implementation used public_path(), which could point to a
     * stale/incorrect credentials file and cause oauth2.googleapis.com/token
     * authentication failures.
     */
    protected function firebaseCredentialsPath(): string
    {
        return config('firebase.credentials', storage_path('app/firebase_credentials.json'));
    }

    public function sendFcmNotification($user_tokens = null, $data = [])
    {
        $tokens = is_array($user_tokens) ? $user_tokens : [$user_tokens];
        $tokens = array_filter($tokens);

        if (empty($tokens)) {
            return null;
        }

        try {
            $setting = app(GeneralSettings::class);
            $title = $data['title'] ?? '';
            $description = $data['text'] ?? '';
            $order_id = isset($data['data']['order_id']) ? (string) $data['data']['order_id'] : null;
            $notification_type = isset($data['data']['notification_type']) ? (string) $data['data']['notification_type'] : '1';
            $projectId = config('services.fcm.project_id');
            $credentialsFilePath = $this->firebaseCredentialsPath();

            if (!$projectId || !is_file($credentialsFilePath)) {
                Log::error('FCM configuration is missing', [
                    'project_id' => $projectId,
                    'credentials_path' => $credentialsFilePath,
                ]);
                return null;
            }

            $client = new GoogleClient();
            $client->setAuthConfig($credentialsFilePath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            $client->refreshTokenWithAssertion();
            $token = $client->getAccessToken();
            $access_token = $token['access_token'] ?? null;

            if (!$access_token) {
                throw new \RuntimeException('Google OAuth access token was not returned.');
            }

            $headers = [
                "Authorization: Bearer {$access_token}",
                'Content-Type: application/json',
            ];

            if ($notification_type === '1' && $order_id) {
                $action = env('APP_URL')."/admin/applies-orders/?modal=order".$order_id;
            } elseif (!empty($data['data']['click_action'])) {
                $action = $data['data']['click_action'];
            } else {
                $action = env('APP_URL')."/admin/dashboard";
            }

            $notificationData = array_merge($data['data'] ?? [], [
                'click_action' => $action,
                'icon' => url('/storage/').($setting->logo ?? ''),
            ]);

            $responses = [];
            $errors = [];

            foreach ($tokens as $userToken) {
                $userToken = is_string($userToken) ? $userToken : ($userToken['token'] ?? null);
                if (!$userToken) {
                    continue;
                }

                $message = [
                    'message' => [
                        'token' => $userToken,
                        'notification' => [
                            'title' => $title,
                            'body' => $description,
                        ],
                        'android' => [
                            'notification' => [
                                'sound' => 'default',
                                'icon' => url('/storage/').($setting->logo ?? ''),
                            ],
                            'data' => [
                                'click_action' => $action,
                            ],
                        ],
                        'apns' => [
                            'payload' => [
                                'aps' => [
                                    'sound' => 'default',
                                    'icon' => url('/storage/').($setting->logo ?? ''),
                                ],
                            ],
                        ],
                        'data' => array_map('strval', $notificationData),
                    ],
                ];

                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://fcm.googleapis.com/v1/projects/{$projectId}/messages:send");
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($message));

                $response = curl_exec($ch);
                $err = curl_error($ch);
                $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                curl_close($ch);

                if ($err) {
                    $errors[$userToken] = $err;
                    continue;
                }

                $decoded = json_decode($response, true);
                if ($httpCode >= 400) {
                    $errors[$userToken] = $decoded ?: ['http_code' => $httpCode, 'response' => $response];
                } else {
                    $responses[$userToken] = $decoded;
                }
            }

            if (!empty($errors)) {
                Log::warning('Some FCM notifications failed', [
                    'successful_count' => count($responses),
                    'failed_count' => count($errors),
                    'errors' => $errors,
                ]);
            }

            return [
                'message' => empty($errors) ? 'All notifications have been sent' : 'Some notifications failed to send',
                'successful' => $responses,
                'errors' => $errors,
            ];
        } catch (\Throwable $e) {
            // Notification failure must never cancel an order that was already created.
            Log::error('FCM notification failed', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return null;
        }
    }

    protected function messaging(): Messaging
    {
        $path = $this->firebaseCredentialsPath();
        $factory = (new Factory())->withServiceAccount($path);
        return $factory->createMessaging();
    }

    public function sendFcmNotificationTobic($user_tokens = null, array $data = [])
    {
        $isTopic = (bool)($data['is_topic'] ?? false);
        $topic = isset($data['topic']) ? trim((string)$data['topic']) : null;
        $tokens = is_array($user_tokens) ? array_values(array_filter($user_tokens)) : array_filter([$user_tokens]);

        if ($isTopic && empty($topic)) {
            return response()->json(['message' => 'Topic name is required when is_topic = true'], 400);
        }
        if (!$isTopic && empty($tokens)) {
            return response()->json(['message' => 'No device tokens provided'], 400);
        }

        try {
            $setting = app(GeneralSettings::class);
            $title = $data['title'] ?? '';
            $body = $data['text'] ?? '';

            if (($data['data']['notification_type'] ?? null) == '1' && !empty($data['data']['order_id'])) {
                $action = env('APP_URL')."/admin/applies-orders/?modal=order".$data['data']['order_id'];
            } elseif (!empty($data['data']['click_action'])) {
                $action = $data['data']['click_action'];
            } else {
                $action = env('APP_URL')."/admin/dashboard";
            }

            $requiredData = [
                'notificationType' => '1',
                'notification_type' => '1',
                'notification_sound' => 'long',
            ];

            $extraData = array_merge($data['data'] ?? [], $requiredData, [
                'click_action' => $action,
                'icon' => url('/storage/').($setting->logo ?? ''),
            ]);

            $android = AndroidConfig::fromArray([
                'priority' => 'high',
                'notification' => [
                    'sound' => 'default',
                ],
            ]);

            $apns = ApnsConfig::fromArray([
                'headers' => ['apns-priority' => '10'],
                'payload' => ['aps' => [
                    'sound' => 'last_sound.aiff',
                ]],
            ]);

            if ($isTopic) {
                $subscribeReport = null;
                if (!empty($tokens)) {
                    $subscribeReport = $this->subscribeTokensToTopic($tokens, $topic);
                }

                $message = CloudMessage::withTarget('topic', $topic)
                    ->withNotification(Notification::create($title, $body))
                    ->withData(array_map('strval', $extraData))
                    ->withAndroidConfig($android)
                    ->withApnsConfig($apns);

                $messageName = $this->messaging()->send($message);

                return response()->json([
                    'message' => 'Notification sent to topic',
                    'is_topic' => true,
                    'topic' => $topic,
                    'subscribe_report' => $subscribeReport,
                    'message_name' => $messageName,
                ]);
            }

            $messages = [];
            foreach ($tokens as $t) {
                $messages[] = CloudMessage::withTarget('token', $t)
                    ->withNotification(Notification::create($title, $body))
                    ->withData(array_map('strval', $extraData))
                    ->withAndroidConfig($android)
                    ->withApnsConfig($apns);
            }

            $report = $this->messaging()->sendAll($messages);
            $results = [];
            foreach ($report->responses() as $i => $response) {
                $token = $tokens[$i] ?? null;
                $results[] = $response->isSuccess()
                    ? ['token' => $token, 'ok' => true, 'message_name' => $response->messageId()]
                    : ['token' => $token, 'ok' => false, 'error' => $response->error()->getMessage()];
            }

            $success = array_values(array_filter($results, fn($r) => $r['ok']));
            $failed = array_values(array_filter($results, fn($r) => !$r['ok']));

            return response()->json([
                'message' => 'Notifications processed (per-token)',
                'is_topic' => false,
                'total' => count($tokens),
                'success_count' => count($success),
                'failure_count' => count($failed),
                'results' => $results,
            ]);
        } catch (\Throwable $e) {
            Log::error('FCM topic/token notification failed', [
                'message' => $e->getMessage(),
            ]);
            return response()->json([
                'message' => 'Notification failed but the main operation was not blocked',
            ], 200);
        }
    }

    protected function subscribeTokensToTopic(array $tokens, string $topic): array
    {
        $tokens = array_column($tokens, 'token');
        if (empty($tokens)) {
            return ['success' => 0, 'failure' => 0, 'errors' => []];
        }

        $report = $this->messaging()->subscribeToTopic($topic, $tokens);
        return [
            'success' => count($report),
            'failure' => 0,
            'errors' => [],
        ];
    }

    protected function unsubscribeTokensFromTopic(array $tokens, string $topic): array
    {
        $tokens = array_values(array_filter(array_map('strval', $tokens)));
        if (empty($tokens)) {
            return ['success' => 0, 'failure' => 0, 'errors' => []];
        }

        $report = $this->messaging()->unsubscribeFromTopic($topic, $tokens);
        return [
            'success' => count($report),
            'failure' => 0,
            'errors' => [],
        ];
    }
}
