<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\MetaConversionsService;

class OrderObserver
{
    /**
     * Send one Purchase event when a customer order first becomes pending.
     * The event ID is deterministic, so repeated callbacks can be deduplicated by Meta.
     */
    public function updated(Order $order): void
    {
        if (!$order->wasChanged('status')) {
            return;
        }

        if ($order->status !== 'pending' || $order->type !== 'current') {
            return;
        }

        // Run after the HTTP response so Meta latency/failures never delay checkout.
        app()->terminating(function () use ($order) {
            app(MetaConversionsService::class)->sendPurchase($order);
        });
    }
}
