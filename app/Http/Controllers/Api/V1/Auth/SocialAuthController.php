<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Auth\UserResource;
use App\Http\Traits\ApiResponses;
use App\Models\SocialAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialAuthController extends Controller
{
    use ApiResponses;

    /**
     * Redirect the user to the provider authentication page.
     * Kept for server-driven OAuth flows.
     */
    public function redirectToProvider($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        $redirectUrl = url('/api/auth/social/' . $provider . '/callback');

        return response()->json([
            'url' => Socialite::driver($provider)
                ->redirectUrl($redirectUrl)
                ->stateless()
                ->redirect()
                ->getTargetUrl(),
        ]);
    }

    /**
     * Complete a server-driven OAuth callback.
     */
    public function handleProviderCallback($provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        try {
            $redirectUrl = url('/api/auth/social/' . $provider . '/callback');
            \Log::info('Callback URL: ' . $redirectUrl);

            $providerUser = Socialite::driver($provider)
                ->redirectUrl($redirectUrl)
                ->stateless()
                ->user();
        } catch (\Throwable $e) {
            \Log::error('Social login callback error: ' . $e->getMessage());
            return $this->errorResponse(trans('auth.social_login_failed'), 400);
        }

        return $this->loginProviderUser($provider, $providerUser);
    }

    /**
     * Token-based social login for Flutter / SPA clients.
     *
     * The client authenticates with Facebook or Google first, then sends the
     * provider access token here. The backend verifies that token directly
     * with the provider before creating or signing in the local user.
     */
    public function handleProviderToken(Request $request, $provider)
    {
        $validated = $this->validateProvider($provider);
        if (!is_null($validated)) {
            return $validated;
        }

        $validator = Validator::make($request->all(), [
            'access_token' => 'required|string',
            'mobile' => 'nullable|string|max:30',
            'country_code' => 'nullable|string|max:10',
            'fcm_id' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors()->first(), 422);
        }

        try {
            $providerUser = Socialite::driver($provider)
                ->stateless()
                ->userFromToken($request->access_token);
        } catch (\Throwable $e) {
            \Log::error('Social token verification failed [' . $provider . ']: ' . $e->getMessage());
            return $this->errorResponse('تعذر التحقق من حساب ' . ucfirst($provider) . '.', 400);
        }

        return $this->loginProviderUser(
            $provider,
            $providerUser,
            $request->mobile,
            $request->country_code,
            $request->fcm_id
        );
    }

    /**
     * Find/create the local user and return the response shape expected by
     * the customer application: data.user_data + data.register.
     */
    protected function loginProviderUser(
        string $provider,
        $providerUser,
        ?string $mobile = null,
        ?string $countryCode = null,
        ?string $fcmId = null
    ) {
        $providerId = trim((string) $providerUser->getId());
        $email = $providerUser->getEmail();
        $email = is_string($email) ? trim($email) : null;

        if ($providerId === '') {
            return $this->errorResponse('لم يرجع مزود تسجيل الدخول رقم مستخدم صالح.', 400);
        }

        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_user_id', $providerId)
            ->first();

        $user = $socialAccount?->user;
        $register = 0;

        if (!$user && !empty($email)) {
            $user = User::where('email', $email)
                ->where('account_type', 'user')
                ->first();
        }

        if (!$user) {
            $register = 1;
            $user = User::create([
                'added_by' => 1,
                'name' => $providerUser->getName()
                    ?? $providerUser->getNickname()
                    ?? ucfirst($provider) . ' User',
                'email' => $email,
                'password' => Str::random(32),
                'email_verified_at' => !empty($email) ? now() : null,
                'account_type' => 'user',
                'status' => 'accepted',
            ]);
        }

        if ($user->status === 'declined') {
            return $this->errorResponse(trans('api.your account has declined'), 403);
        }

        $user->socialAccounts()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_user_id' => $providerId,
            ],
            ['provider' => $provider]
        );

        if (!empty($mobile)) {
            $mobileExists = User::where('account_type', 'user')
                ->where('mobile', $mobile)
                ->where('id', '!=', $user->id)
                ->exists();

            if ($mobileExists) {
                return $this->errorResponse(trans('api.mobile already exist'), 422);
            }

            $user->mobile = $mobile;
            if (!empty($countryCode)) {
                $user->country_code = $countryCode;
            }
        }

        if (!empty($fcmId)) {
            $user->fcm_id = $fcmId;
            $user->newOrExistingToken($fcmId);
        }

        $user->save();

        $token = JWTAuth::fromUser($user);
        $userData = UserResource::make($user->fresh())->getToken($token);

        return $this->successResponse([
            'user_data' => $userData,
            'register' => $register,
        ], trans('api.signed'));
    }

    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return $this->errorResponse(trans('auth.unsupported_provider'), 422);
        }

        return null;
    }
}
