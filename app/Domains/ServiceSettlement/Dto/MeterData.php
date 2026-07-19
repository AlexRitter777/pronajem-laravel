<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto;

use App\Enums\MeterType;
use Brick\Math\BigDecimal;

final readonly class MeterData
{

    public function __construct(
        public ?int $id,
        public MeterType $meterTypeId,
        public string $meterTypeName,
        public int $meterNumber,
        public BigDecimal $startValue,
        public BigDecimal $endValue,
    ) {
    }


    public static function fromArray(array $data) : self
    {
        return new self(
            id: is_numeric($data['id'] ?? null) ? (int) $data['id'] : null,
            meterTypeId: MeterType::from($data['typeId']),
            meterTypeName: $data['typeName'],
            meterNumber: $data['meterNumber'] ?? null,
            startValue: BigDecimal::of((string) $data['startValue']),
            endValue: BigDecimal::of((string) $data['endValue']),
        );
    }


}
