<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto\Calculation;

use App\Enums\MeterType;
use Brick\Math\BigDecimal;

final readonly class SingleMeterResult
{
    public function __construct(
        public MeterType $meterType,
        public string $meterNumber,
        public BigDecimal $startValue,
        public BigDecimal $endValue,
        public ?BigDecimal $coefficient,
        public BigDecimal $totalReading,
    ){}



}
