<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto;

use Brick\Math\BigDecimal;

final readonly class HeatingCoefficientsData
{

    public function __construct(
        public ?BigDecimal $firstCoefficient,
        public ?BigDecimal $secondCoefficient,
        public ?BigDecimal $thirdCoefficient,
    ){}

    public static function fromArray(array $data) : self
    {
        return new self(
            firstCoefficient: isset($data['firstCoefficient']) ? BigDecimal::of((string) $data['firstCoefficient']) : null,
            secondCoefficient: isset($data['secondCoefficient']) ? BigDecimal::of((string) $data['secondCoefficient']) : null,
            thirdCoefficient: isset($data['thirdCoefficient']) ? BigDecimal::of((string) $data['thirdCoefficient']) : null,
        );
    }

}
