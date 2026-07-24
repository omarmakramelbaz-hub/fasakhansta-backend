<?php

namespace App\Financial\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTransactionEntry extends Model
{
    protected $table = 'financial_transaction_entries';

    protected $fillable = [
        'transaction_id',
        'financial_account_id',
        'entry_type',
        'amount',
        'currency',
        'description',
        'metadata',
    ];

    protected $casts = [
        'amount' => 'decimal:4',
        'metadata' => 'array',
    ];

    public function transaction()
    {
        return $this->belongsTo(
            FinancialTransaction::class,
            'transaction_id'
        );
    }

    public function account()
    {
        return $this->belongsTo(
            FinancialAccount::class,
            'financial_account_id'
        );
    }
}
