<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Calculation;

final readonly class PeriodResult
{

    public function __construct(
        public bool $isFullYear,
        public int $occupancyDays,
        public int $invoicingYearDays
    ){}

}
