<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto;

use App\Domains\ServiceSettlement\Enums\CoefficientMode;
use Brick\Math\BigDecimal;

final readonly class CoefficientData
{

    public function __construct(
        public CoefficientMode $mode,
        public ?BigDecimal $expensesCoefficient,
        public ?BigDecimal $hotWaterCoefficient,
        public ?BigDecimal $heatingCoefficient,
        public ?BigDecimal $coldWaterAndWasteCoefficient,
    ){}

    public static function fromArray(array $data, CoefficientMode $mode) : self
    {
        return new self(
            mode: $mode,
            expensesCoefficient: isset($data['expensesCoefficient']) ? BigDecimal::of((string) $data['expensesCoefficient']) : null,
            hotWaterCoefficient: isset($data['hotWaterCoefficient']) ? BigDecimal::of((string) $data['hotWaterCoefficient']) : null,
            heatingCoefficient: isset($data['heatingCoefficient']) ? BigDecimal::of((string) $data['heatingCoefficient']) : null,
            coldWaterAndWasteCoefficient: isset($data['coldWaterAndWasteCoefficient']) ? BigDecimal::of((string) $data['coldWaterAndWasteCoefficient']) : null,
        );
    }


}
