<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Order;

class ResetOrderNumbers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * php artisan orders:reset-numbers
     */
    protected $signature = 'orders:reset-numbers';

    /**
     * The console command description.
     */
    protected $description = 'Reset order_no per restaurant starting from 16800 with prefix';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $startFrom = 16800;
        $this->info("Starting to reset order_no for each restaurant...");

        $restaurants = Order::select('resturant_id')
            ->distinct()
            ->pluck('resturant_id');

        foreach ($restaurants as $restaurantId) {
            $orders = Order::where('resturant_id', $restaurantId)
                ->orderBy('created_at')
                ->get();

            $order_no = $startFrom;
            $prefix = 'R' . $restaurantId . '-';

            foreach ($orders as $order) {
                $order->order_no = $prefix . $order_no;
                $order->save();
                $order_no++;
            }

            $this->info("Updated orders for restaurant ID: $restaurantId");
        }

        $this->info("✅ All order_no values have been reset successfully with prefix.");
    }
}
