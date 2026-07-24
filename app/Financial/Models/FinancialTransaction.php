<?php

namespace App\Financial\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialTransaction extends Model
{
    protected $table = 'financial_transactions';

    protected $fillable = [
        'uuid',
        'type',
        'status',
        'reference_type',
        'reference_id',
        'idempotency_key',
        'description',
        'metadata',
        'completed_at',
    ];

    protected $casts = [
        'metadata' => 'array',
        'completed_at' => 'datetime',
    ];

    public function entries()
    {
        return $this->hasMany(
            FinancialTransactionEntry::class,
            'transaction_id'
        );
    }

    public function reference()
    {
        return $this->morphTo();
    }
}
