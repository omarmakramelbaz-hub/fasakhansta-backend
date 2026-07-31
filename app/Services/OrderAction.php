<?php

namespace App\Services;

class OrderAction
{
    public const NEW = 'new';
    public const ACCEPTED = 'accepted';
    public const DECLINED = 'declined';
    public const PREPARED = 'prepared';
    public const OUT_FOR_DELIVERY = 'out_for_delivery';
    public const COMPLETED = 'completed';
    public const CANCELLED = 'cancelled';
}
