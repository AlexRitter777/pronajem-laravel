<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto\Calculation;

use Carbon\CarbonImmutable;

final readonly class PeriodResult
{

    public function __construct(
        public bool $isFullYear,
        public CarbonImmutable $tenantOccupancyStartDate,
        public CarbonImmutable $tenantOccupancyEndDate,
        public int $invoicingYear,
        public int $occupancyDays,
        public int $invoicingYearDays
    ){}

}
