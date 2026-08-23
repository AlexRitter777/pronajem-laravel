<?php

use App\Domains\ServiceSettlement\Calculation\DateResolver;
use Carbon\CarbonImmutable;

it('resolves dates and full year period', function () {


    $startDate = CarbonImmutable::create(2023, 1, 1);
    $endDate = CarbonImmutable::create(2023, 12, 31);

    $result = app(DateResolver::class)->resolve(
        tenantOccupancyStartDate: $startDate,
        tenantOccupancyEndDate: $endDate,
        invoicingYear: 2023
    );

    expect($result->isFullYear)->toBeTrue()
        ->and($result->occupancyDays)->toBe(365)
        ->and($result->invoicingYearDays)->toBe(365);


});

it('resolves dates and partial year period', function () {

    $startDate = CarbonImmutable::create(2024, 3, 10);
    $endDate = CarbonImmutable::create(2024, 10, 25);

    $result = app(DateResolver::class)->resolve(
        tenantOccupancyStartDate: $startDate,
        tenantOccupancyEndDate: $endDate,
        invoicingYear: 2024
    );

    expect($result->isFullYear)->toBeFalse()
        ->and($result->occupancyDays)->toBe(230)
        ->and($result->invoicingYearDays)->toBe(366);

});

it('throws an exception if the end date is before the start date', function () {

    $startDate = CarbonImmutable::create(2024, 1, 1);
    $endDate = CarbonImmutable::create(2023, 12, 31);

    $this->expectException(InvalidArgumentException::class);
    $this->expectExceptionMessage('Tenant occupancy end date must be after tenant occupancy start date');

    app(DateResolver::class)->resolve(
        tenantOccupancyStartDate: $startDate,
        tenantOccupancyEndDate: $endDate,
        invoicingYear: 2024
    );

});
