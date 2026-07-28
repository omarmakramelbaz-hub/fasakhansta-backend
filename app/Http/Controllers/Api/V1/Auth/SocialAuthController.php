<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\SocialAccount;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\Api\Auth\UserResource;
use App\Http\Traits\ApiResponses;

class SocialAuthController extends Controller
{
    use ApiResponses;

    /**
     * Redirect the user to the provider authentication page.
     *
     * @param string $provider (google, facebook, etc.)
     * @return \Illuminate\Http\JsonResponse
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
     * Obtain the user information from the provider.
     *
     * @param string $provider
     * @return \Illuminate\Http\JsonResponse
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
        } catch (\Exception $e) {
            \Log::error('Social login error: ' . $e->getMessage());
            return $this->errorResponse(trans('auth.social_login_failed'), 400);
        }


        // Check if we have a user with this email
        $user = User::where('email', $providerUser->getEmail())->first();

        // If user doesn't exist, create a new one
        if (!$user) {
            $user = User::create([
                'name' => $providerUser->getName() ?? $providerUser->getNickname(),
                'email' => $providerUser->getEmail(),
                'password' => bcrypt(Str::random(16)), // Random password
                'email_verified_at' => now(),
                'account_type' => 'user', // Default account type
            ]);
        }

        // Create or update social account
        $user->socialAccounts()->updateOrCreate(
            [
                'provider' => $provider,
                'provider_user_id' => $providerUser->getId(),
            ],
            ['provider' => $provider]
        );

        // Generate token
        $token = JWTAuth::fromUser($user);
        $userData = UserResource::make($user)->getToken($token);

        return $this->successResponse($userData, trans('api.signed'));
    }

    /**
     * Validate the provider.
     *
     * @param $provider
     * @return \Illuminate\Http\JsonResponse|null
     */
    protected function validateProvider($provider)
    {
        if (!in_array($provider, ['facebook', 'google'])) {
            return $this->errorResponse(trans('auth.unsupported_provider'), 422);
        }
        
        return null;
    }
}
