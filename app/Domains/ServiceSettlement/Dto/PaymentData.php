<?php

namespace App\Domains\ServiceSettlement\Dto;

use Brick\Money\Money;

final readonly class PaymentData
{

    public function __construct(
        public ?int $id,
        public int $month,
        public int $year,
        public Money $amount,
    ){}


    public static function fromArray(array $data) : self
    {
        return new self(
            id: is_numeric($data['id'] ?? null) ? (int) $data['id'] : null,
            month: $data['month'],
            year: $data['year'],
            amount: Money::of( (string) $data['amount'], 'CZK')

        );
    }

}
