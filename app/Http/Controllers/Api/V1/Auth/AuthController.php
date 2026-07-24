<?php

namespace App\Http\Controllers\Api\V1\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Area;
use App\Models\Order;
use App\Models\Contract;
use Illuminate\Http\Request;
use App\Http\Traits\UploadImageTrait;
use App\Http\Resources\Api\Auth\UserResource;
use App\Http\Resources\Api\Auth\ContractResource;
use App\Http\Requests\Api\Auth\StoreAuthRequest;
use App\Http\Requests\Api\Auth\StoreVendorRequest;
use App\Http\Requests\Api\Auth\LoginRequest;
use App\Http\Requests\Api\Auth\UpdateAuthRequest;
use App\Http\Requests\Api\Auth\UpdateUserPhotoRequest;
use App\Http\Requests\Api\Auth\UpdateVendorRequest;
use App\Http\Requests\Api\Auth\UpdatePositionRequest;
use App\Http\Requests\Api\Auth\UpdatePhoneRequest;
use App\Http\Requests\Api\Auth\UpdatePhotoRequest;
use App\Http\Traits\ApiResponses;
use Notification;
use JWTAuth;
use Hash;
use Validator;
use Auth;
use TaqnyatSms;
use App\Interfaces\Api\AuthRepositoryInterface;

class AuthController extends Controller {

  use ApiResponses;
  use UploadImageTrait;

    private AuthRepositoryInterface $authRepository;
    public function __construct(AuthRepositoryInterface $authRepository) 
    {      
        $this->authRepository = $authRepository;
    }
    public function contract($type){
        $contract=new ContractResource(Contract::where('type',$type)->first());
        return $this->successResponse($contract,trans('api.success data'));
    }
 public function login(LoginRequest $request){
    $userDetails = $request->validated();   
    $user = $this->authRepository->login($userDetails);
    if(is_object($user)){
        $userData = UserResource::make($user)->getToken(JWTAuth::fromUser($user));
        
        return $this->successResponse($userData , __('api.signed'));
    }else if($user == 1){
        return $this->errorResponse(__('api.failed'));
    }else if($user == 2){
        return $this->errorResponse(__('api.failed_in_data'));
    }else if($user == 3){
        return $this->errorResponse(__('api.wait admin activate your account'));
    }else if($user == 4){
        return $this->errorResponse(__('api.your account has declined'));
    }else if($user == 6){
     
        // return $this->errorResponse(__('api.your account has disabled check your wallet'));
    }else if($user == 5){
        return $this->errorResponse(__('api.failed'));
    }
  }
  
   public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    
        if($validator->fails()){
            return $this->errorResponse($validator->errors()->first());
        }
        $user=User::where('id', auth()->guard('api')->user()->id)->first();
        
        if($user)
        {
            if(Hash::check($request->current_password, $user->password) ){
                $user->update(['password' => $request->get('password')]);
                $data = UserResource::make($user)->getToken(JWTAuth::fromUser($user));
                return $this->successResponse($data,trans('api.password changed'));
            }else{
                return $this->errorResponse(trans('api.error in current password'));
            }
        }
        return $this->errorResponse(trans('api.error in password'));
    }
    
     public function UpdateProfile($account_type,UpdateAuthRequest $request){
        $userDetails = $request->validated();   
        $id = auth('api')->user()->id;
        $user = $this->authRepository->update($id,$userDetails);
        $userData=User::find(auth('api')->user()->id);
        $getData = new UserResource($userData);
        return $this->successResponse($getData,trans('api.updated profile successfully'));
    }
    
    public function UpdatePhoto($account_type,UpdatePhotoRequest $request){
        $userDetails = $request->validated();   
        $id = auth('api')->user()->id;
        $user = $this->authRepository->update($id,$userDetails);
        $userData=User::find(auth('api')->user()->id);
        $getData = new UserResource($userData);
        return $this->successResponse($getData,trans('api.updated profile successfully'));
    }
    
     public function UpdatePosition(UpdatePositionRequest $request){
        $userDetails = $request->validated();   
        $id = auth('api')->user()->id;
        $user = $this->authRepository->update($id,$userDetails);
        \Log::info('ffff');
        $city_name = getCityName($userDetails['lat'],$userDetails['lng']);         

        $area = Area::where('title_ar', 'like', '%' . $city_name . '%')->orWhere('title_en', 'like', '%' . $city_name . '%')->first();
        if($area){
            $user = User::find($id);
            $user->area_id = $area->id;
            $user->save();
        }
        $userData=User::find(auth('api')->user()->id);
        $getData = new UserResource($userData);
        return $this->successResponse($getData,trans('api.updated position successfully'));
    }
    
    public function logout() {
      $id= Auth::guard('api')->user()->id;
      $up_key=User::where('id', $id)->first();
    //   $up_key->tokens()->where('token',auth('api')->user()->fcm_id)->delete();
      $up_key->update(['fcm_id'=> null]);      
      $data = Auth::guard('api')->logout();
      
      return $this->successResponse($data,trans('api.logout successfully'));
   }
   
      public function register(StoreAuthRequest $request) {
    
        $userDetails = $request->validated();    
        $user = $this->authRepository->create($userDetails);
        if(is_object($user)){
            return $this->successResponse(null,__('api.your request has send'));
        }else{
            return $this->errorResponse(__('api.already exist'));
        }
      }
        public function profile(){
        $userDetails = auth()->user()->id;   
        $user = $this->authRepository->profile($userDetails);
        if(is_object($user)){
            $getData = UserResource::make($user)->getToken(JWTAuth::fromUser($user));
            return $this->successResponse($getData,trans('api.user profile'));
        }else if($user == 1){
            return $this->errorResponse(trans('api.error in user type'));
        }
    }
    public function UpdatePhone(UpdatePhoneRequest $request){
        if ($request->wantsJson() || $request->is('api/*')) {

        $user=User::where('id', auth()->guard('api')->user()->id)->first();
        }
        else{
                    $user=User::where('id', $request->user_id)->first();
        }
        if($user)
        {
             if(User::where('account_type',$user->account_type)->where('mobile',$request->mobile)->where('id','!=',$user->id)->first()){
                         if ($request->wantsJson() || $request->is('api/*')) {

                return $this->errorResponse(trans('api.mobile already exist'));
                         }else{
                             return back()->with('error',trans('api.mobile already exist'));
                         }
                }
            if(Hash::check($request->current_password, $user->password) ){
                $user->update(['mobile' => $request->get('mobile')]);
                $data = UserResource::make($user)->getToken(JWTAuth::fromUser($user));
                
                if ($request->wantsJson() || $request->is('api/*')) {

                return $this->successResponse($data,trans('api.updated phone successfully'));
                         }else{
                             return back()->with('success',trans('api.updated phone successfully'));
                         }
                
            }else{
                   if ($request->wantsJson() || $request->is('api/*')) {

                return $this->errorResponse(trans('api.error in current password'));
                         }else{
                             return back()->with('error',trans('api.error in current password'));
                         }
            }
        }

           if ($request->wantsJson() || $request->is('api/*')) {

                return $this->errorResponse(trans('api.api.error in password'));
           }else{
                return back()->with('error',trans('api.api.error in password'));
           }
    }

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

        return response()->json([
            'url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl(),
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
            $providerUser = Socialite::driver($provider)->stateless()->user();
        } catch (\Exception $e) {
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