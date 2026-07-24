<?php

namespace App\Financial\Contracts;

use App\Financial\DTOs\PostTransactionData;
use App\Financial\Models\FinancialTransaction;

interface LedgerContract
{
    /**
     * Post a balanced financial transaction.
     */
    public function post(PostTransactionData $transaction): FinancialTransaction;
}
