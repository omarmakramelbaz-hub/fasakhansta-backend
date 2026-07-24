<?php

namespace App\Financial\DTOs;

final class LedgerEntryData
{
    public string $entryType;

    public int $financialAccountId;

    public string $amount;

    public string $currency;

    public ?string $description;

    public array $metadata;

    public function __construct(
        string $entryType,
        int $financialAccountId,
        string $amount,
        string $currency = 'EGP',
        ?string $description = null,
        array $metadata = []
    ) {
        $this->entryType = $entryType;
        $this->financialAccountId = $financialAccountId;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->description = $description;
        $this->metadata = $metadata;
    }
}
