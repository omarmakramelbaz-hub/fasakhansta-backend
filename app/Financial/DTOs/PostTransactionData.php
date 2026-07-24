<?php

namespace App\Financial\DTOs;

final class PostTransactionData
{
    public string $type;

    public string $description;

    public ?string $referenceType;

    public ?int $referenceId;

    public ?string $idempotencyKey;

    /**
     * @var LedgerEntryData[]
     */
    public array $entries;

    public array $metadata;

    public function __construct(
        string $type,
        string $description,
        array $entries,
        ?string $referenceType = null,
        ?int $referenceId = null,
        ?string $idempotencyKey = null,
        array $metadata = []
    ) {
        $this->type = $type;
        $this->description = $description;
        $this->entries = $entries;
        $this->referenceType = $referenceType;
        $this->referenceId = $referenceId;
        $this->idempotencyKey = $idempotencyKey;
        $this->metadata = $metadata;
    }
}
