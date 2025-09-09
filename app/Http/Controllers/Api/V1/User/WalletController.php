<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Models\Wallet;
use App\Models\Order;
use App\Models\User;
use App\Models\GeneralSettings;
use Illuminate\Http\Request;
use App\Http\Traits\ApiResponses;
use JWTAuth;
use Validator;
use Auth;
use App\Interfaces\ServiceRepositoryInterface;
use App\Http\Requests\Api\User\ChargingWalletRequest;
use App\Http\Requests\Api\User\TransferWalletRequest;
use App\Http\Resources\Api\User\WalletResource;
use App\Http\Resources\Api\Auth\UserResource;
use App\Http\Controllers\Payment\PaymobController;
use Notification;
class WalletController extends Controller {

    use ApiResponses;
  
     
     //  =============================================charging_wallet==================================
         
    public function charging_wallet(ChargingWalletRequest $request){
            if ($request->wantsJson() || $request->is('api/*')) {
                $user = auth('api')->user();
            }
            else{
                $user = auth('admin')->user();
            }
            if($user->email==null ){
                if($request->wantsJson() || $request->is('api/*')){
                    return $this->successResponse($user->balance,__('api.please update your info and enter email first'));
                }else{
                    return redirect()->back()->with(['error'=>__('api.please update your info and enter email first')]);
                }
            }
            $wallet=Wallet::create([
                'from_user'=>$user->id,
                'to_user'=>$user->id,
                'type'=>'charging',
                'amount'=>$request->amount,
                'status' => 'pending',
                ]);
            if($wallet){
                $order=Order::create([
                    'user_id'=>$user->id,
                    'status' => null,
                    'type'=>'wallet',
                    'wallet_id' => $wallet->id,
                ]);
            if(request()->payment_method == 'online'){
                                // return (new PaymobController)->refund(42);
                $wallet->payment = 'visa';
                $wallet->save();
                return (new PaymobController)->checkingOut(
                        'paymob_card_payment',
                        env('PAYMOB_CARD_INTEGRATION_ID'),
                        $order->id,
                        env('PAYMOB_CARD_IFRAME_ID'));
             }else if (request()->payment_method == 'v_cash')
             {
                $wallet->payment = 'v_cash';
                $wallet->save();
                return (new PaymobController)->checkingOut(
                        'paymob_mobile_wallet_payment',
                        env('PAYMOB_MOBILE_WALLET_INTEGRATION_ID'),
                        $order->id,
                        '0'.$order->pending_vendor?->mobile);
             }
            }
            $wallet->save();
            // $user=auth('api')->user();
            // $user->balance=$user->balance+$request->amount;
            // $user->save();
            if ($request->wantsJson() || $request->is('api/*')) {
                return $this->successResponse($user->balance,__('api.wallet charge successfully'));
            }else{
                return redirect()->back();
            }
        
    }
    
    public function get_wallet(){
        if (request()->wantsJson() || request()->is('api/*')) {
        $user=auth('api')->user();
        }
        else{
            $user= auth('admin')->user();
        }
            $wallet= $user->user_transactions();
            $data=[
            'wallet'=>WalletResource::collection($wallet),
            'balance'=>(double) $user->balance,
            'profile'=>UserResource::make($user)->getToken(JWTAuth::fromUser($user)),
            
            ];
            if (request()->wantsJson() || request()->is('api/*')) {
                return $this->successResponse($data,__('api.success data'));
            }else{
                return view('admin.users.wallet',compact('data','wallet'));
            }
    }
    
    public function check_user(TransferWalletRequest $request){
        $user=User::where('mobile',$request->mobile)->where('account_type',$request->account_type)->first();
        if($user){
            if(auth('api')->user()->balance >= $request->amount){
                $data=[
                    'user_id'=>$user->id,
                    'username'=>$user->name,
                    ];
                return $this->successResponse($data,__('api.success data'));
            }else{
                
                return $this->errorResponse(__('api.charge your wallet first'));
            }
        }else{
            return $this->errorResponse(__('api.user not found'));
        }
    }
    
     public function transfer_wallet(TransferWalletRequest $request){
        $user=User::where('mobile',$request->mobile)->where('account_type',$request->account_type)->first();
        if($user){
            if(auth('api')->user()->balance >= $request->amount){
                 $wallet=Wallet::create([
                'from_user'=>auth('api')->user()->id,
                'to_user'=>$user->id,
                'type'=>'transfer',
                'amount'=>$request->amount,
                'status' => 'completed',
                ]);
                $user->update(['balance'=>$user->balance+$request->amount]);
                if($user->balance > $user->min_wallet/2 && $user->status=='disabled'){
                    $user->update(['status' =>'accepted']);
                }
                $own_user=auth('api')->user();
                $own_user->update(['balance'=>$own_user->balance-$request->amount]);
                 Notification::send($user,new \App\Notifications\NotifyTransferWallet($own_user,$request->amount));
                return $this->successResponse($wallet,__('api.transfer successfully'));
            }else{
                
                return $this->errorResponse(__('api.charge your wallet first'));
            }
        }else{
            return $this->errorResponse(__('api.user not found'));
        }
    }
    
    

  
}