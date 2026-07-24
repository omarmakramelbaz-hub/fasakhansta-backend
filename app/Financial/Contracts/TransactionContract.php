<?php

namespace App\Financial\Contracts;

use App\Financial\Models\FinancialTransaction;

interface TransactionContract
{
    /**
     * Create a new financial transaction.
     *
     * @param array $attributes
     * @return FinancialTransaction
     */
    public function create(array $attributes): FinancialTransaction;

    /**
     * Mark transaction as completed.
     *
     * @param FinancialTransaction $transaction
     * @return FinancialTransaction
     */
    public function complete(FinancialTransaction $transaction): FinancialTransaction;

    /**
     * Mark transaction as failed.
     *
     * @param FinancialTransaction $transaction
     * @return FinancialTransaction
     */
    public function fail(FinancialTransaction $transaction): FinancialTransaction;
}
