<?php

namespace App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\GeneralSettings;
use App\Models\User;
use App\Models\Wallet;
use Carbon\Carbon;
use DB;
use Notification;
class WalletController extends Controller
{
    public function __construct() 
    {
        $this->middleware('permission:wallet-list', ['only' => ['index']]);
        $this->middleware('permission:wallet-create', ['only' => ['create']]);
    }

    public function index(GeneralSettings $settings)
    {
        $wallets = Wallet::whereNull('from_user')->where('type','transfer')->where('payment','wallet')->where('status','completed')->orderBy('created_at','desc')->paginate(30);
        return view('admin.wallets.index',compact('wallets','settings'));
    }
    
    public function store(Request $request, GeneralSettings $settings)
    {
        // if($settings->app_balance >= $request->amount){
           $wallet= Wallet::create($request->except('_token')+['payment' => 'wallet', 'status' => 'completed']);
            $user=User::findOrFail($request->to_user);
            $user->update(['balance' => $user->balance+ $wallet->amount]);
            if($user->balance > $user->min_wallet/2 && $user->status=='disabled'){
                $user->update(['status' =>'accepted']);
            }
            Notification::send($user,new \App\Notifications\NotifyTransferWallet(auth('admin')->user(),$request->amount));
            return redirect()->back()->with('success',trans('messages.transferDone'));
        // }else{
        //      return redirect()->back()->with('error',trans('messages.balance not enough'));
        // }
        
    }
    
    public function wallet_transactions(){
        return view('admin.wallets.transactions');
    }
    
       public function withdraw(GeneralSettings $settings)
    {
        $wallets = Wallet::whereNull('to_user')->where('type','withdraw')->where('payment','wallet')->where('status','completed')->paginate(30);
        return view('admin.wallets.withdraw',compact('wallets','settings'));
    }
    
    public function store_withdraw(Request $request, GeneralSettings $settings)
    {
        
           $wallet= Wallet::create($request->except('_token')+['payment' => 'wallet', 'status' => 'completed']);
            $user=User::findOrFail($request->from_user);
            if($user->balance >= $wallet->amount){
               
                $user->update(['balance' => $user->balance- $wallet->amount]);
                Notification::send($user,new \App\Notifications\NotifyWithdrawWallet(auth('admin')->user(),$request->amount));
                return redirect()->back()->with('success',trans('messages.transferDone'));
            }else{
                 return redirect()->back()->with('error',trans("messages.User's wallet is not enough to withdraw the amount"));
            }
        
    }

}
