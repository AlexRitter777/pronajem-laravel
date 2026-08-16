<?php

use App\Domains\ServiceSettlement\Dto\CoefficientData;
use App\Domains\ServiceSettlement\Dto\ExpenseData;
use App\Domains\ServiceSettlement\Dto\HeatingCoefficientsData;
use App\Domains\ServiceSettlement\Dto\MeterData;
use App\Domains\ServiceSettlement\Dto\PaymentData;
use App\Domains\ServiceSettlement\Dto\ServiceSettlementData;
use App\Domains\ServiceSettlement\Enums\CoefficientMode;
use Carbon\CarbonImmutable;


it('builds from a full array without meters data', function () {


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
        'coefficients' => [],
        'meters' => [],

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

        'heatingCoefficients' => [],

        'hasAnnualConsumptionComponent' => false,

        'utility_hot_water' => 100.55,
        'utility_cold_water' => '1200.55',
        'utility_heating' => '1500.55',
        'utility_cold_water_for_hot' => 1235


    ]);

    expect($dto->landlordId)->toBe(1)
        ->and($dto->landlordName)->toBe('Karel Braun')

        ->and($dto->tenantId)->toBe(21)
        ->and($dto->tenantName)->toBe('Vasyl Hampl')

        ->and($dto->propertyId)->toBe(12)
        ->and($dto->propertyAddress)->toBe('Sazovicka 492/5, Praha 5')

        ->and($dto->invoicingYear)->toBe(2025)

        ->and($dto->tenantOccupancyStartDate->format('Y-m-d'))->toBe('2025-01-01')
        ->and($dto->tenantOccupancyStartDate)->toBeInstanceOf(CarbonImmutable::class)
        ->and($dto->tenantOccupancyEndDate->format('Y-m-d'))->toBe('2025-10-25')
        ->and($dto->tenantOccupancyEndDate)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->coefficients)->toBeInstanceOf(CoefficientData::class)
        ->and($dto->coefficients->mode)->toBe(CoefficientMode::NONE)

        ->and($dto->meterData)->toBeArray()
        ->toHaveCount(0)

        ->and($dto->expenseData)->toBeArray()
        ->toHaveCount(2)
        ->each->toBeInstanceOf(ExpenseData::class)

        ->and($dto->paymentData)->toBeArray()
        ->toHaveCount(2)
        ->each->toBeInstanceOf(PaymentData::class)

        ->and($dto->heatingCoefficientsData)->toBeInstanceOf(HeatingCoefficientsData::class)
        ->and($dto->heatingCoefficientsData->firstCoefficient)->toBeNull()
        ->and($dto->heatingCoefficientsData->secondCoefficient)->toBeNull()
        ->and($dto->heatingCoefficientsData->thirdCoefficient)->toBeNull()

        ->and($dto->hotWaterFixedAmount)->toBeNull()
        ->and($dto->hotWaterUnitPrice)->toBeNull()

        ->and($dto->coldWaterForHotUnitPrice)->toBeNull()

        ->and($dto->coldWaterUnitPrice)->toBeNull()

        ->and($dto->heatingFixedAmount)->toBeNull()
        ->and($dto->heatingUnitPrice)->toBeNull()

        ->and($dto->hasAnnualConsumptionComponent)->toBeFalse()

        ->and($dto->utilityHotWater->isEqualTo('100.55'))->toBeTrue()
        ->and($dto->utilityColdWater->isEqualTo('1200.55'))->toBeTrue()
        ->and($dto->utilityHeating->isEqualTo('1500.55'))->toBeTrue()
        ->and($dto->utilityColdWaterForHot->isEqualTo('1235'))->toBeTrue()
    ;


});



it('builds from a full array with meters data', function () {


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
        'useOneCoefficient' => false,
        'useManyCoefficients' => true,
        'coefficients' => [
            'expensesCoefficient' => '1.5',
            'hotWaterCoefficient' => '2.0',
            'heatingCoefficient' => '0.75',
            'coldWaterAndWasteCoefficient' => '1.25',
        ],
        'meters' => [
            [
                'typeId' => 'hot_water',
                'typeName' => 'Teplá voda',
                'meterNumber' => '12345',
                'startValue' => '5',
                'endValue' => '15.5',
            ],
            [
                'typeId' => 'cold_water',
                'typeName' => 'Studená voda',
                'meterNumber' => '12345',
                'startValue' => '5',
                'endValue' => '15.5',
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

        'heatingCoefficients' => [
            'firstCoefficient' => '1.5',
            'secondCoefficient' => '0.35',
            'thirdCoefficient' => null,
        ],

        'hotWaterRate' => [
            'fixedAmount' => '1500.55',
            'unitPrice' => 150.55,
        ],

        'coldWaterForHotRate' => [
            'unitPrice' => '100.55',
        ],

        'coldWaterRate' => [
            'unitPrice' => '150.55',
        ],

        'heatingRate' => [
            'fixedAmount' => '1500.55',
            'unitPrice' => 150.55,
        ],

        'hasAnnualConsumptionComponent' => false,



    ]);

    expect($dto->landlordId)->toBe(1)
        ->and($dto->landlordName)->toBe('Karel Braun')

        ->and($dto->tenantId)->toBe(21)
        ->and($dto->tenantName)->toBe('Vasyl Hampl')

        ->and($dto->propertyId)->toBe(12)
        ->and($dto->propertyAddress)->toBe('Sazovicka 492/5, Praha 5')

        ->and($dto->invoicingYear)->toBe(2025)

        ->and($dto->tenantOccupancyStartDate->format('Y-m-d'))->toBe('2025-01-01')
        ->and($dto->tenantOccupancyStartDate)->toBeInstanceOf(CarbonImmutable::class)
        ->and($dto->tenantOccupancyEndDate->format('Y-m-d'))->toBe('2025-10-25')
        ->and($dto->tenantOccupancyEndDate)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->meterData)->toBeArray()
            ->toHaveCount(2)
            ->each->toBeInstanceOf(MeterData::class)

        ->and($dto->coefficients)->toBeInstanceOf(CoefficientData::class)
        ->and($dto->coefficients->mode)->toBe(CoefficientMode::MANY)
        ->and($dto->coefficients->hotWaterCoefficient->isEqualTo('2.0'))->toBeTrue()
        ->and($dto->coefficients->heatingCoefficient->isEqualTo('0.75'))->toBeTrue()
        ->and($dto->coefficients->coldWaterAndWasteCoefficient->isEqualTo('1.25'))->toBeTrue()
        ->and($dto->coefficients->expensesCoefficient->isEqualTo('1.5'))->toBeTrue()

        ->and($dto->expenseData)->toBeArray()
            ->toHaveCount(2)
            ->each->toBeInstanceOf(ExpenseData::class)

        ->and($dto->paymentData)->toBeArray()
            ->toHaveCount(2)
            ->each->toBeInstanceOf(PaymentData::class)

        ->and($dto->heatingCoefficientsData)->toBeInstanceOf(HeatingCoefficientsData::class)
        ->and($dto->heatingCoefficientsData->firstCoefficient->isEqualTo('1.5'))->toBeTrue()
        ->and($dto->heatingCoefficientsData->secondCoefficient->isEqualTo('0.35'))->toBeTrue()
        ->and($dto->heatingCoefficientsData->thirdCoefficient)->toBeNull()

        ->and($dto->hotWaterFixedAmount->isEqualTo('1500.55'))->toBeTrue()
        ->and($dto->hotWaterUnitPrice->isEqualTo('150.55'))->toBeTrue()

        ->and($dto->coldWaterForHotUnitPrice->isEqualTo('100.55'))->toBeTrue()

        ->and($dto->coldWaterUnitPrice->isEqualTo('150.55'))->toBeTrue()

        ->and($dto->heatingFixedAmount->isEqualTo('1500.55'))->toBeTrue()
        ->and($dto->heatingUnitPrice->isEqualTo('150.55'))->toBeTrue()

        ->and($dto->hasAnnualConsumptionComponent)->toBeFalse()
    ;


});

it('sets null for optional fields and empty array for payments and meters', function () {


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
        'useOneCoefficient' => false,
        'useManyCoefficients' => false,
        'meters' => [],

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

        'hasAnnualConsumptionComponent' => false,
        'payments' => [],


    ]);


    expect($dto->landlordId)->toBe(1)
        ->and($dto->landlordName)->toBe('Karel Braun')
        ->and($dto->tenantId)->toBe(21)

        ->and($dto->tenantName)->toBe('Vasyl Hampl')
        ->and($dto->propertyId)->toBe(12)

        ->and($dto->propertyAddress)->toBe('Sazovicka 492/5, Praha 5')
        ->and($dto->invoicingYear)->toBe(2026)

        ->and($dto->tenantOccupancyStartDate->format('Y-m-d'))->toBe('2025-01-01')
        ->and($dto->tenantOccupancyStartDate)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->tenantOccupancyEndDate->format('Y-m-d'))->toBe('2025-10-25')
        ->and($dto->tenantOccupancyEndDate)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->coefficients)->toBeInstanceOf(CoefficientData::class)

        ->and($dto->meterData)->toBeArray()
            ->toHaveCount(0)

        ->and($dto->expenseData)->toBeArray()
        ->toHaveCount(2)
            ->each->toBeInstanceOf(ExpenseData::class)

        ->and($dto->paymentData)->toBeArray()->toHaveCount(0)

        ->and($dto->utilityHotWater)->toBeNull()
        ->and($dto->utilityColdWater)->toBeNull()
        ->and($dto->utilityHotWater)->toBeNull()
        ->and($dto->utilityColdWaterForHot)->toBeNull()

        ->and($dto->hasAnnualConsumptionComponent)->toBeFalse()
    ;

});


it('builds from a full array with meters data and consumption component', function () {


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
        'useOneCoefficient' => true,
        'useManyCoefficients' => false,
        'coefficients' => [
            'expensesCoefficient' => '1.5',

        ],
        'meters' => [
            [
                'typeId' => 'hot_water',
                'typeName' => 'Teplá voda',
                'meterNumber' => '12345',
                'startValue' => '5',
                'endValue' => '15.5',
            ],
            [
                'typeId' => 'cold_water',
                'typeName' => 'Studená voda',
                'meterNumber' => '12345',
                'startValue' => '5',
                'endValue' => '15.5',
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

        'heatingCoefficients' => [
            'firstCoefficient' => '1.5',
            'secondCoefficient' => '0.354',
            'thirdCoefficient' => null,
        ],

        'hotWaterRate' => [
            'fixedAmount' => '1500.55',
            'unitPrice' => 150.55,
        ],

        'coldWaterForHotRate' => [
            'unitPrice' => '100.55',
        ],

        'coldWaterRate' => [
            'unitPrice' => '150.55',
        ],

        'heatingRate' => [
            'fixedAmount' => '1500.55',
        ],

        'hasAnnualConsumptionComponent' => true,

        'meterStartYearValue' => 15,
        'meterEndYearValue' => '20',
        'annualConsumption' => '1000.50',




    ]);

    expect($dto->landlordId)->toBe(1)
        ->and($dto->landlordName)->toBe('Karel Braun')

        ->and($dto->tenantId)->toBe(21)
        ->and($dto->tenantName)->toBe('Vasyl Hampl')

        ->and($dto->propertyId)->toBe(12)
        ->and($dto->propertyAddress)->toBe('Sazovicka 492/5, Praha 5')

        ->and($dto->invoicingYear)->toBe(2025)

        ->and($dto->tenantOccupancyStartDate->format('Y-m-d'))->toBe('2025-01-01')
        ->and($dto->tenantOccupancyStartDate)->toBeInstanceOf(CarbonImmutable::class)
        ->and($dto->tenantOccupancyEndDate->format('Y-m-d'))->toBe('2025-10-25')
        ->and($dto->tenantOccupancyEndDate)->toBeInstanceOf(CarbonImmutable::class)

        ->and($dto->coefficients)->toBeInstanceOf(CoefficientData::class)
        ->and($dto->coefficients->mode)->toBe(CoefficientMode::ONE)
        ->and($dto->coefficients->expensesCoefficient->isEqualTo('1.5'))->toBeTrue()


        ->and($dto->meterData)->toBeArray()
        ->toHaveCount(2)
        ->each->toBeInstanceOf(MeterData::class)

        ->and($dto->expenseData)->toBeArray()
        ->toHaveCount(2)
        ->each->toBeInstanceOf(ExpenseData::class)

        ->and($dto->paymentData)->toBeArray()
        ->toHaveCount(2)
        ->each->toBeInstanceOf(PaymentData::class)

        ->and($dto->heatingCoefficientsData)->toBeInstanceOf(HeatingCoefficientsData::class)
        ->and($dto->heatingCoefficientsData->firstCoefficient->isEqualTo('1.5'))->toBeTrue()
        ->and($dto->heatingCoefficientsData->secondCoefficient->isEqualTo('0.354'))->toBeTrue()
        ->and($dto->heatingCoefficientsData->thirdCoefficient)->toBeNull()

        ->and($dto->hotWaterFixedAmount->isEqualTo('1500.55'))->toBeTrue()
        ->and($dto->hotWaterUnitPrice->isEqualTo('150.55'))->toBeTrue()

        ->and($dto->coldWaterForHotUnitPrice->isEqualTo('100.55'))->toBeTrue()

        ->and($dto->coldWaterUnitPrice->isEqualTo('150.55'))->toBeTrue()

        ->and($dto->heatingFixedAmount->isEqualTo('1500.55'))->toBeTrue()
        ->and($dto->heatingUnitPrice)->toBeNull()

        ->and($dto->hasAnnualConsumptionComponent)->toBeTrue()
        ->and((string) $dto->annualConsumption->getAmount())->toBe('1000.50')
        ->and($dto->meterStartYearValue->isEqualTo('15'))->toBeTrue()
        ->and($dto->meterEndYearValue->isEqualTo('20'))->toBeTrue()
    ;


});
