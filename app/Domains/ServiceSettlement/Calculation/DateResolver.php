<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Calculation;

use App\Domains\ServiceSettlement\Dto\Calculation\PeriodResult;
use App\Domains\Shared\ValueObjects\SettlementYear;
use Carbon\CarbonImmutable;

final class DateResolver
{

    public function resolve(
        CarbonImmutable $tenantOccupancyStartDate,
        CarbonImmutable $tenantOccupancyEndDate,
        int $invoicingYear
    ) : PeriodResult
    {

        if($tenantOccupancyEndDate->isBefore($tenantOccupancyStartDate)) {
            throw new \InvalidArgumentException('Tenant occupancy end date must be after tenant occupancy start date');
        }

        $invoicingYear = SettlementYear::fromInt($invoicingYear);

        $occupancyDays = (int) ($tenantOccupancyStartDate->diffInDays($tenantOccupancyEndDate)) + 1;

        return new PeriodResult(
            isFullYear: $this->isFullYear($tenantOccupancyStartDate, $tenantOccupancyEndDate),
            tenantOccupancyStartDate: $tenantOccupancyStartDate,
            tenantOccupancyEndDate: $tenantOccupancyEndDate,
            invoicingYear: $invoicingYear->toInt(),
            occupancyDays: $occupancyDays,
            invoicingYearDays: $invoicingYear->daysInYear(),
        );


    }


    private function isFullYear(CarbonImmutable $tenantOccupancyStartDate, CarbonImmutable $tenantOccupancyEndDate) : bool
    {
        return $tenantOccupancyStartDate->isSameDay($tenantOccupancyStartDate->startOfYear())
            && $tenantOccupancyEndDate->isSameDay($tenantOccupancyEndDate->endOfYear());
    }

}
