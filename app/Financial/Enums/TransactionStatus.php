<?php

namespace App\Financial\Enums;

final class TransactionStatus
{
    public const PENDING = 'pending';

    public const PROCESSING = 'processing';

    public const COMPLETED = 'completed';

    public const FAILED = 'failed';

    public const CANCELLED = 'cancelled';

    public const REVERSED = 'reversed';
}

