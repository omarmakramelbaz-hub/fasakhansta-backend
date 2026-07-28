<?php

namespace App\Jobs;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Http\Controllers\Api\V1\Vendor\OrderController;

class ProcessCart implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $order;
 
    /**
     * Create a new job instance.
     *
     * @param  App\Models\Order  $order
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        if($this->order->delegate_id == null){
            $result = (new OrderController)->searchDelegates();
        
            \Log::info($result);
        }
    }
}
