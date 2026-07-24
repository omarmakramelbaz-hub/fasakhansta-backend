<?php

namespace App\Financial\Services;

use App\Financial\Contracts\LedgerContract;
use App\Financial\DTOs\PostTransactionData;
use App\Financial\Models\FinancialTransaction;
use App\Financial\Models\FinancialTransactionEntry;
use App\Financial\Models\FinancialAccount;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class LedgerService implements LedgerContract
{
    public function post(PostTransactionData $transaction): FinancialTransaction
    {
        return DB::transaction(function () use ($transaction) {

            // Prevent duplicate transactions
            if ($transaction->idempotencyKey) {

                $existing = FinancialTransaction::where(
                    'idempotency_key',
                    $transaction->idempotencyKey
                )->first();

                if ($existing) {
                    return $existing;
                }
            }

            // Validate double-entry accounting
            $this->validateBalancedEntries($transaction->entries);

            // Lock all accounts
           $this->lockAccounts($transaction->entries);

            // Create transaction header
            $financialTransaction = FinancialTransaction::create([
                'uuid' => (string) Str::uuid(),
                'type' => $transaction->type,
                'status' => 'pending',
                'reference_type' => $transaction->referenceType,
                'reference_id' => $transaction->referenceId,
                'idempotency_key' => $transaction->idempotencyKey,
                'description' => $transaction->description,
                'metadata' => $transaction->metadata,
            ]);

            // Create ledger entries
            $this->createEntries(
                $financialTransaction,
                $transaction->entries
            );

            return $financialTransaction;
        });
    }

    /**
     * Create transaction entries.
     */
    private function createEntries(
        FinancialTransaction $transaction,
        array $entries
    ): void {

        foreach ($entries as $entry) {

            FinancialTransactionEntry::create([

                'transaction_id' => $transaction->id,

                'financial_account_id' => $entry->financialAccountId,

                'entry_type' => $entry->entryType,

                'amount' => $entry->amount,

                'currency' => $entry->currency,

                'description' => $entry->description,

                'metadata' => $entry->metadata,
            ]);
        }
    }

    /**
     * Ensure debits equal credits.
     */
/**
 * Lock all financial accounts involved in the transaction.
 */
    private function lockAccounts(array $entries): void
{
    $accountIds = collect($entries)
        ->pluck('financialAccountId')
        ->unique()
        ->sort()
        ->values()
        ->toArray();

    FinancialAccount::query()
        ->whereIn('id', $accountIds)
        ->lockForUpdate()
        ->get();
}
    private function validateBalancedEntries(array $entries): void
    {
        $debit = 0;
        $credit = 0;

        foreach ($entries as $entry) {

            if ($entry->entryType === 'debit') {
                $debit += $entry->amount;
            }

            if ($entry->entryType === 'credit') {
                $credit += $entry->amount;
            }
        }

        if (bccomp((string) $debit, (string) $credit, 4) !== 0) {

            throw new \InvalidArgumentException(
                'Transaction entries are not balanced.'
            );
        }
    }
}
