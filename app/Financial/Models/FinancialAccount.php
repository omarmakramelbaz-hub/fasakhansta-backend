<?php

namespace App\Financial\Models;

use Illuminate\Database\Eloquent\Model;

class FinancialAccount extends Model
{
    protected $table = 'financial_accounts';

    protected $fillable = [
        'uuid',
        'owner_type',
        'owner_id',
        'account_type',
        'currency',
        'available_balance',
        'held_balance',
        'is_active',
        'metadata',
    ];

    protected $casts = [
        'available_balance' => 'decimal:4',
        'held_balance'      => 'decimal:4',
        'metadata'          => 'array',
        'is_active'         => 'boolean',
    ];

    public function owner()
    {
        return $this->morphTo();
    }

    public function entries()
    {
        return $this->hasMany(
            FinancialTransactionEntry::class,
            'financial_account_id'
        );
    }
}
