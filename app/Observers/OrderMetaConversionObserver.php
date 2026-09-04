<?php

namespace App\Observers;

use App\Models\Order;
use App\Services\MetaConversionsService;

class OrderMetaConversionObserver
{
    /**
     * Send Purchase once when a normal customer order first becomes pending.
     * Cash, wallet and successful online-payment flows all converge on this state.
     */
    public function updated(Order $order): void
    {
        if (!$order->wasChanged('status')) {
            return;
        }

        if ($order->status !== 'pending' || $order->type !== 'current') {
            return;
        }

        app()->terminating(function () use ($order) {
            app(MetaConversionsService::class)->sendPurchase($order);
        });
    }
}
