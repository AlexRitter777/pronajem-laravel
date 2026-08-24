<?php

declare(strict_types=1);


namespace App\Domains\ServiceSettlement\Dto\Calculation;

use Brick\Math\BigDecimal;

final readonly class MetersResult
{
    public function __construct(
        public BigDecimal $hotWaterTotalReading,
        public BigDecimal $coldWaterTotalReading,
        public BigDecimal $heatingTotalReading,
        public array $meters,

    ){}

}
