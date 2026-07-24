<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use App\Models\Order;
use Notification;
use App\Models\Resturant;
use Mail;
class OpenCloseResturantCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:open_close_resturant';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Note: open_close_resturant !';

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
         \Log::info("Cron is open_close_resturant!");

       $currentTime = now()->format('H:i:s');

       $openedCount = 0;
       $closedCount = 0;

     $restaurants = Resturant::all();

foreach ($restaurants as $restaurant) {

   $open = $restaurant->open_at;
$close = $restaurant->close_at;

$shouldBeOpen = false;

// إذا كان الغلق عند منتصف الليل، اعتبره نهاية اليوم
if ($close == '00:00:00') {
    $close = '23:59:59';
}

// نفس اليوم
if ($open < $close) {

    if ($currentTime >= $open && $currentTime < $close) {
        $shouldBeOpen = true;
    }

}
// يمتد لليوم التالي
else {

    if ($currentTime >= $open || $currentTime < $close) {
        $shouldBeOpen = true;
    }

}

    if ($shouldBeOpen) {

        if ($restaurant->status != 'opened') {

            $orders = Order::where('resturant_id', $restaurant->id)
                ->whereIn('order_type', ['schedule', 'another_zone'])
                ->whereDate('schedule_date', now()->toDateString())
                ->where('status', 'pending')
                ->get();

            foreach ($orders as $order) {

                try {

                    $to_email = $order->resturant?->user?->email;

                    if (!empty($to_email)) {

                        Mail::send(
                            'emails.reminder_today_orders_email',
                            ['cart' => $order],
                            function ($message) use ($to_email) {
                                $message->to($to_email);
                                $message->subject('reminder schedule order today');
                            }
                        );

                    }

                } catch (\Throwable $e) {

                    \Log::error($e->getMessage());

                }

            }

            $restaurant->update([
                'status' => 'opened'
            ]);

            $openedCount++;

        }

    } else {

        if ($restaurant->status != 'closed') {

            $restaurant->update([
                'status' => 'closed'
            ]);

            $closedCount++;

        }

    }

}

\Log::info("OpenCloseResturant Finished - Opened: {$openedCount}, Closed: {$closedCount}");

}

}
