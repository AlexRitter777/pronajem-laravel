<?php

use App\Domains\ServiceSettlement\Dto\CoefficientData;
use App\Domains\ServiceSettlement\Dto\ExpenseData;
use App\Domains\ServiceSettlement\Dto\MeterData;
use App\Domains\ServiceSettlement\Dto\PaymentData;
use App\Domains\ServiceSettlement\Dto\ServiceSettlementData;
use Carbon\CarbonImmutable;

it('builds from a full array', function () {


    $dto = ServiceSettlementData::fromArray([

        'landlord_id' => 1,
        'landlord_name' => 'Karel Braun',
        'tenant_id' => 21,
        'tenant_name' => 'Vasyl Hampl',
        'property_id' => 12,
        'property_address' => 'Sazovicka 492/5, Praha 5',
        'invoicingYear' => 2025,
        'tenantOccupancyStartDate' => '2025-01-01',
        'tenantOccupancyEndDate' => '2025-10-25',
        'coefficients' => [
            'useOneCoefficient' => false,
            'useManyCoefficients' => true,
            'expensesCoefficient' => '1.5',
            'hotWaterCoefficient' => '2.0',
            'heatingCoefficient' => '0.75',
            'hotWaterAndWasteCoefficient' => '1.25',
        ],
        'meters' => [
            [
                'typeId' => 'hot_water',
                'typeName' => 'Teplá voda',
                'meterNumber' => 12345,
                'startValue' => '5',
                'endValue' => '15.5',
                'startYearValue' => '1',
                'endYearValue' => '20',
            ],
            [
                'typeId' => 'cold_water',
                'typeName' => 'Studená voda',
                'meterNumber' => 12345,
                'startValue' => '5',
                'endValue' => '15.5',
                'startYearValue' => '1',
                'endYearValue' => '20',
            ],

        ],

        'expenses' => [
            [
                'expenseTypeId' => 2,
                'expenseTypeName' => 'Opravy',
                'amount' => '1500.00',
            ],
            [
                'expenseTypeId' => 5,
                'expenseTypeName' => 'Vytah',
                'amount' => '1500.47',
            ]
        ],

        'payments' => [
            [
                'id' => 1,
                'month' => 3,
                'year' => 2025,
                'amount' => 10.99,
            ],

            [
                'id' => 2,
                'month' => 4,
                'year' => 2025,
                'amount' => 12.33,
            ]
        ],

        'utility_hot_water' => 1500.55,
        'utility_cold_water' => '1500.55',
        'utility_heating' => '1500.55',
        'utility_cold_water_for_hot' => '1000',


    ]);

    expect($dto->landlordId)->toBe(1)

        ->and($dto->landlordName)->toBe('Karel Braun')
        ->and($dto->tenantId)->toBe(21)

        ->and($dto->tenantName)->toBe('Vasyl Hampl')
        ->and($dto->propertyId)->toBe(12)

        ->and($dto->propertyAddress)->toBe('Sazovicka 492/5, Praha 5')
        ->and($dto->invoicingYear->format('Y'))->toBe('2025')

        ->and($dto->invoicingYear)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->tenantOccupancyStartDate->format('Y-m-d'))->toBe('2025-01-01')
        ->and($dto->tenantOccupancyStartDate)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->tenantOccupancyEndDate->format('Y-m-d'))->toBe('2025-10-25')
        ->and($dto->tenantOccupancyEndDate)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->coefficients)->toBeInstanceOf(CoefficientData::class)

        ->and($dto->meterData)->tobeArray()
            ->toHaveCount(2)
            ->each->toBeInstanceOf(MeterData::class)

        ->and($dto->expenseData)->toBeArray()
            ->toHaveCount(2)
            ->each->toBeInstanceOf(ExpenseData::class)

        ->and($dto->paymentData)->toBeArray()
            ->toHaveCount(2)
            ->each->toBeInstanceOf(PaymentData::class)

        ->and($dto->utilityHotWater->getAmount()->__toString())->toBe('1500.55')
        ->and($dto->utilityColdWater->getAmount()->__toString())->toBe('1500.55')
        ->and($dto->utilityHotWater->getAmount()->__toString())->toBe('1500.55')
        ->and($dto->utilityColdWaterForHot->getAmount()->__toString())->toBe('1000.00')
    ;




});

it('sets null for optional fields and empty array for payments', function () {


    $dto = ServiceSettlementData::fromArray([

        'landlord_id' => 1,
        'landlord_name' => 'Karel Braun',
        'tenant_id' => 21,
        'tenant_name' => 'Vasyl Hampl',
        'property_id' => 12,
        'property_address' => 'Sazovicka 492/5, Praha 5',
        'invoicingYear' => 2026,
        'tenantOccupancyStartDate' => '2025-01-01',
        'tenantOccupancyEndDate' => '2025-10-25',
        'coefficients' => [
            'useOneCoefficient' => false,
            'useManyCoefficients' => false,
        ],
        'meters' => [
            [
                'typeId' => 'hot_water',
                'typeName' => 'Teplá voda',
                'meterNumber' => 12345,
                'startValue' => '5',
                'endValue' => '15.5',
                'startYearValue' => '1',
                'endYearValue' => '20',
            ],

        ],

        'expenses' => [
            [
                'expenseTypeId' => 2,
                'expenseTypeName' => 'Opravy',
                'amount' => '1500.00',
            ],
            [
                'expenseTypeId' => 5,
                'expenseTypeName' => 'Vytah',
                'amount' => '1500.47',
            ]
        ],

        'payments' => [],


    ]);


    expect($dto->landlordId)->toBe(1)
        ->and($dto->landlordName)->toBe('Karel Braun')
        ->and($dto->tenantId)->toBe(21)

        ->and($dto->tenantName)->toBe('Vasyl Hampl')
        ->and($dto->propertyId)->toBe(12)

        ->and($dto->propertyAddress)->toBe('Sazovicka 492/5, Praha 5')
        ->and($dto->invoicingYear->format('Y'))->toBe('2026')

        ->and($dto->invoicingYear)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->tenantOccupancyStartDate->format('Y-m-d'))->toBe('2025-01-01')
        ->and($dto->tenantOccupancyStartDate)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->tenantOccupancyEndDate->format('Y-m-d'))->toBe('2025-10-25')
        ->and($dto->tenantOccupancyEndDate)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->coefficients)->toBeInstanceOf(CoefficientData::class)

        ->and($dto->meterData)->tobeArray()
        ->toHaveCount(1)
            ->each->toBeInstanceOf(MeterData::class)

        ->and($dto->expenseData)->toBeArray()
        ->toHaveCount(2)
            ->each->toBeInstanceOf(ExpenseData::class)

        ->and($dto->paymentData)->toBeArray()->toHaveCount(0)

        ->and($dto->utilityHotWater)->toBeNull()
        ->and($dto->utilityColdWater)->toBeNull()
        ->and($dto->utilityHotWater)->toBeNull()
        ->and($dto->utilityColdWaterForHot)->toBeNull()
    ;

});
