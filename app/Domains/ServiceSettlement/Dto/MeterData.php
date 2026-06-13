<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto;

use Brick\Math\BigDecimal;

final readonly class MeterData
{

    public function __construct(
        public ?int $id,
        public int $meterTypeId,
        public string $meterTypeName,
        public ?int $meterNumber,
        public BigDecimal $startValue,
        public BigDecimal $endValue,
        public BigDecimal $startYearValue,
        public BigDecimal $endYearValue,
    ) {
    }


    public static function fromArray(array $data) : self
    {
        return new self(
            id: is_numeric($data['id'] ?? null) ? (int) $data['id'] : null,
            meterTypeId: $data['meterTypeId'],
            meterTypeName: $data['meterTypeName'],
            meterNumber: $data['meterNumber'] ?? null,
            startValue: BigDecimal::of((string) $data['startValue']),
            endValue: BigDecimal::of((string) $data['endValue']),
            startYearValue: BigDecimal::of((string) $data['startYearValue']),
            endYearValue: BigDecimal::of((string)$data['endYearValue'])
        );
    }


}
