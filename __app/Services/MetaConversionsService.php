<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MetaConversionsService
{
    public function sendPurchase(Order $order): void
    {
        if (!filter_var(config('services.meta_conversions.enabled', false), FILTER_VALIDATE_BOOLEAN)) {
            return;
        }

        $datasetId = trim((string) config('services.meta_conversions.dataset_id'));
        $accessToken = trim((string) config('services.meta_conversions.access_token'));

        if ($datasetId === '' || $accessToken === '') {
            Log::warning('Meta Purchase event skipped: missing dataset ID or access token', [
                'order_id' => $order->id,
            ]);
            return;
        }

        $order->loadMissing('user');

        $payload = [
            'data' => [
                [
                    'event_name' => 'Purchase',
                    'event_time' => now()->timestamp,
                    'event_id' => 'purchase_order_' . $order->id,
                    'action_source' => 'app',
                    'user_data' => $this->buildUserData($order),
                    'custom_data' => [
                        'currency' => (string) config('services.meta_conversions.currency', 'EGP'),
                        'value' => (float) $order->grand_total,
                        'order_id' => (string) $order->id,
                    ],
                    'app_data' => [
                        // The backend does not know per-device ATT/app tracking consent.
                        // Keep both flags conservative unless production has a reliable consent signal.
                        'advertiser_tracking_enabled' => filter_var(
                            config('services.meta_conversions.advertiser_tracking_enabled', false),
                            FILTER_VALIDATE_BOOLEAN
                        ),
                        'application_tracking_enabled' => filter_var(
                            config('services.meta_conversions.application_tracking_enabled', false),
                            FILTER_VALIDATE_BOOLEAN
                        ),
                        'extinfo' => $this->buildExtInfo(),
                    ],
                ],
            ],
        ];

        $testEventCode = trim((string) config('services.meta_conversions.test_event_code'));
        if ($testEventCode !== '') {
            $payload['test_event_code'] = $testEventCode;
        }

        $apiVersion = trim((string) config('services.meta_conversions.api_version', 'v24.0'));
        $url = sprintf(
            'https://graph.facebook.com/%s/%s/events',
            $apiVersion,
            $datasetId
        );

        try {
            $response = Http::withToken($accessToken)
                ->asJson()
                ->timeout(4)
                ->retry(2, 200)
                ->post($url, $payload);

            if ($response->failed()) {
                Log::warning('Meta Purchase event failed', [
                    'order_id' => $order->id,
                    'status' => $response->status(),
                    'response' => $response->json(),
                ]);
                return;
            }

            Log::info('Meta Purchase event sent', [
                'order_id' => $order->id,
                'event_id' => 'purchase_order_' . $order->id,
                'dataset_id' => $datasetId,
            ]);
        } catch (\Throwable $exception) {
            // Meta tracking must never block or fail the customer order flow.
            Log::warning('Meta Purchase event exception', [
                'order_id' => $order->id,
                'message' => $exception->getMessage(),
            ]);
        }
    }

    private function buildUserData(Order $order): array
    {
        $userData = [];
        $user = $order->user;

        $email = $this->normalizeEmail($user?->email);
        if ($email !== null) {
            $userData['em'] = [hash('sha256', $email)];
        }

        $phone = $this->normalizeEgyptPhone($user?->mobile);
        if ($phone !== null) {
            $userData['ph'] = [hash('sha256', $phone)];
        }

        if ($order->user_id) {
            $userData['external_id'] = [hash('sha256', (string) $order->user_id)];
        }

        return $userData;
    }

    private function normalizeEmail($email): ?string
    {
        if (!$email) {
            return null;
        }

        $normalized = strtolower(trim((string) $email));
        return filter_var($normalized, FILTER_VALIDATE_EMAIL) ? $normalized : null;
    }

    private function normalizeEgyptPhone($phone): ?string
    {
        if (!$phone) {
            return null;
        }

        $digits = preg_replace('/\D+/', '', (string) $phone);
        if (!$digits) {
            return null;
        }

        if (strlen($digits) === 11 && str_starts_with($digits, '0')) {
            return '20' . substr($digits, 1);
        }

        if (strlen($digits) === 10 && str_starts_with($digits, '1')) {
            return '20' . $digits;
        }

        return $digits;
    }

    private function buildExtInfo(): array
    {
        $platform = strtolower((string) config('services.meta_conversions.app_platform', 'android'));
        $isIos = $platform === 'ios';

        $packageName = $isIos
            ? (string) config('services.meta_conversions.ios_bundle_id', 'com.faskhaninja.clients')
            : (string) config('services.meta_conversions.android_package', 'com.smartvision.faskhanista');

        $shortVersion = (string) config('services.meta_conversions.app_version', '');
        $longVersion = (string) config('services.meta_conversions.app_build', '');

        // Meta requires extinfo values in this exact sequence. Unknown device-specific
        // values are represented by empty placeholders so no client app update is needed.
        return [
            $isIos ? 'i2' : 'a2',
            $packageName,
            $shortVersion,
            $longVersion,
            '', // OS version is not available server-side.
            '', // Device model.
            (string) config('services.meta_conversions.app_locale', 'ar_EG'),
            '', // Timezone abbreviation.
            '', // Carrier.
            '', // Screen width.
            '', // Screen height.
            '', // Screen density.
            '', // CPU cores.
            '', // External storage size.
            '', // Free external storage size.
            (string) config('services.meta_conversions.app_timezone', 'Africa/Cairo'),
        ];
    }
}
