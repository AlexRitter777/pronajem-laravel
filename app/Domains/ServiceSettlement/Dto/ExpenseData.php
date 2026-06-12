<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto;

use Brick\Money\Money;

final readonly class ExpenseData
{

    public function __construct(
        public ?int $id,
        public int $typeId,
        public string $typeName,
        public Money $amount,
    ) {
    }


    public static function fromArray(array $data) : self
    {
        return new self(
            id: is_numeric($data['id'] ?? null) ? (int) $data['id'] : null,
            typeId: $data['expenseTypeId'],
            typeName: $data['expenseTypeName'],
            amount: Money::of( (string) $data['amount'], 'CZK')
        );
    }

}
