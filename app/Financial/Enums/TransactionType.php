<?php

namespace App\Financial\Enums;

final class TransactionType
{
    public const DEPOSIT = 'deposit';

    public const WITHDRAWAL = 'withdrawal';

    public const PAYMENT = 'payment';

    public const REFUND = 'refund';

    public const TRANSFER = 'transfer';

    public const ADJUSTMENT = 'adjustment';

    public const COMMISSION = 'commission';

    public const SETTLEMENT = 'settlement';
}
