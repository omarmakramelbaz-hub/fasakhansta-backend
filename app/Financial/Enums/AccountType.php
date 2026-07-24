<?php

namespace App\Financial\Enums;

final class AccountType
{
    public const PLATFORM_TREASURY = 'platform_treasury';

    public const CUSTOMER = 'customer';

    public const MERCHANT = 'merchant';

    public const DRIVER = 'driver';

    public const HOLDING = 'holding';

    public const COMMISSION = 'commission';

    public const REFUND = 'refund';

    public const DEBT_COLLECTION = 'debt_collection';

    public const EXPENSE = 'expense';

    public const ADJUSTMENT = 'adjustment';

    public static function all(): array
    {
        return [
            self::PLATFORM_TREASURY,
            self::CUSTOMER,
            self::MERCHANT,
            self::DRIVER,
            self::HOLDING,
            self::COMMISSION,
            self::REFUND,
            self::DEBT_COLLECTION,
            self::EXPENSE,
            self::ADJUSTMENT,
        ];
    }
}

