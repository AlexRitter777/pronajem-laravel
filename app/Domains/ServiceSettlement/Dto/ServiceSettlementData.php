<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Dto;

use Brick\Money\Money;
use Carbon\CarbonImmutable;

final readonly class ServiceSettlementData
{

    public function __construct(

        public int $landlordId,
        public string $landlordName,

        public int $tenantId,
        public string $tenantName,

        public int $propertyId,
        public string $propertyAddress,

        public CarbonImmutable $invoicingYear,
        public CarbonImmutable $tenantOccupancyStartDate,
        public CarbonImmutable $tenantOccupancyEndDate,

        public CoefficientData $coefficients,
        public array $meterData,
        public array $paymentData,

        public ?Money $utilityHotWater,
        public ?Money $utilityColdWater,
        public ?Money $utilityHeating,
        public ?Money $utilityColdWaterForHot,

        public array $expenseData,

    ){}

    public static function fromArray(array $data) : self
    {
        $meterData = array_map(fn (array $m) => MeterData::fromArray($m), $data['meters']);
        $expenseData = array_map(fn (array $e) => ExpenseData::fromArray($e), $data['expenses']);
        $paymentData = !empty($data['payments']) ? array_map(fn (array $p) => PaymentData::fromArray($p), $data['payments']) : [];

        return new self(

            landlordId: $data['landlord_id'],
            landlordName: $data['landlord_name'],
            tenantId: $data['tenant_id'],
            tenantName: $data['tenant_name'],
            propertyId: $data['property_id'],
            propertyAddress: $data['property_address'],
            invoicingYear: CarbonImmutable::createFromFormat('Y', $data['invoicingYear']),
            tenantOccupancyStartDate: CarbonImmutable::parse($data['tenantOccupancyStartDate']),
            tenantOccupancyEndDate: CarbonImmutable::parse($data['tenantOccupancyEndDate']),
            coefficients:  CoefficientData::fromArray($data['coefficients']),
            meterData: $meterData,
            paymentData: $paymentData,
            utilityHotWater: isset($data['utility_hot_water']) ? Money::of((string) $data['utility_hot_water'], 'CZK') : null,
            utilityColdWater: isset($data['utility_cold_water']) ? Money::of((string) $data['utility_cold_water'], 'CZK') : null,
            utilityHeating: isset($data['utility_heating']) ? Money::of((string) $data['utility_heating'], 'CZK') : null,
            utilityColdWaterForHot: isset($data['utility_cold_water_for_hot']) ? Money::of((string) $data['utility_cold_water_for_hot'], 'CZK') : null,
            expenseData: $expenseData,

        );
    }


}
