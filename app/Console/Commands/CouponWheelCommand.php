<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\CouponWheel;
use App\Models\User;
use App\Models\Order;
use App\Models\CouponSubscripe;
// use Mail;
use Notification;
// use App\Mail\VendorEmail;
use App\Events\CouponWheelUpdated;
class CouponWheelCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:coupon';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email for wheel coupon subscription winner ';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
         \Log::info("Coupon Cron is working fine!");

        $coupon = CouponWheel::whereDate('end_date', Carbon::now()->subDay())->first();
         \Log::info("Coupon Cron is working fine!".Carbon::now()->subDay());
           if($coupon){
                \Log::info("coupon:".$coupon->id);
                $order=Order::where('coupon_wheel_id',$coupon->id)->inRandomOrder()->first();
            //   $winner=CouponSubscripe::whereNull('status')->inRandomOrder()->first();
              broadcast(new CouponWheelUpdated($coupon))->toOthers();
                if($order){
                   $winner=CouponSubscripe::where('coupon_wheel_id',$order->coupon_wheel_id)->where('user_id',$order->user_id)->first();
                   if($winner){
                    $winner->update(['status'=>'winner']);
                    // send notification to user winner
                    $user_winner = User::where('id',$winner->user_id)->first();
                    if($user_winner){
                        Notification::send($user_winner,new \App\Notifications\NotifyUserCouponWheelWinnerNotification($winner));
                    }
                 
                   }else{
                       $coupon->update(['status'=>'hide']);
                   }
                 \Log::info("winner:".$winner->id);
                   $lossers=CouponSubscripe::where('coupon_wheel_id',$order->coupon_wheel_id)->whereNull('status')->get();
                    foreach($lossers as $loser){
                        $loser->update(['status'=>'loser']);
                    }
                }
                
                
                
            }

//        return 0;
    }
}
