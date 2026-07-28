<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\DelegateNotification;
use Mail;
// use App\Mail\VendorEmail;
class DelegateNotificationCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Note: DelegateNotification will deleted !';

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
         \Log::info("Cron is DelegateNotification!");

        $orders = DelegateNotification::whereDate('created_at', '<', today())->get();
        \Log::info(now()->addDay()->toDateString());
                \Log::info($orders);

        foreach($orders as $order){
            $order->delete();
        }
//        return 0;
    }
}
