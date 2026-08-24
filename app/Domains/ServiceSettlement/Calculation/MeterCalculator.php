<?php

declare(strict_types=1);

namespace App\Domains\ServiceSettlement\Calculation;

use App\Domains\ServiceSettlement\Dto\Calculation\MetersResult;
use App\Domains\ServiceSettlement\Dto\Calculation\SingleMeterResult;
use App\Domains\ServiceSettlement\Dto\HeatingCoefficientsData;
use App\Domains\ServiceSettlement\Dto\MeterData;
use App\Enums\MeterType;
use Brick\Math\BigDecimal;

final class MeterCalculator
{
    /**
     * @param array<MeterData> $meters
     */
    public function calculate(
        array $meters,
        HeatingCoefficientsData $coefficients,
    ) : MetersResult
    {

        $coefficient = $this->calculateCoefficient($coefficients);

        $processedMeters = $this->processMeters($meters, $coefficient);

        $totalConsumptions = $this->calculateTotalConsumptions($processedMeters);

        return new MetersResult(
            hotWaterTotalReading: $totalConsumptions['totalHotWater'],
            coldWaterTotalReading: $totalConsumptions['totalColdWater'],
            heatingTotalReading: $totalConsumptions['totalHeating'],
            meters: $processedMeters,
        );

    }

    private function calculateCoefficient(HeatingCoefficientsData $coefficients) : BigDecimal
    {
        $coefficients = [
            $coefficients->firstCoefficient,
            $coefficients->secondCoefficient,
            $coefficients->thirdCoefficient,
        ];

        $result = BigDecimal::of('1');

        foreach ($coefficients as $coefficient) {
            if($coefficient === null) {
                continue;
            }
            $result = $result->multipliedBy($coefficient);
        }

        return $result;

    }

    private function processMeters(array $meters, BigDecimal $coefficient) : array
    {

        $result = [];

        foreach ($meters as $meter){

            $consumption = $meter->meterTypeId === MeterType::HEATING
                ? $meter->endValue->minus($meter->startValue)->multipliedBy($coefficient)
                : $meter->endValue->minus($meter->startValue);

            $result[] = new SingleMeterResult(
                meterType: $meter->meterTypeId,
                meterNumber: $meter->meterNumber,
                startValue: $meter->startValue,
                endValue: $meter->endValue,
                coefficient: $meter->meterTypeId === MeterType::HEATING ? $coefficient : null,
                totalReading: $consumption,

            );

        }

        return $result;
    }

    private function calculateTotalConsumptions(array $meters) : array
    {
        $totalHeating = BigDecimal::zero();
        $totalColdWater = BigDecimal::zero();
        $totalHotWater = BigDecimal::zero();

        foreach ($meters as $meter){

            match ($meter->meterType) {
                MeterType::HEATING => $totalHeating = $totalHeating->plus($meter->totalReading),
                MeterType::COLD_WATER => $totalColdWater = $totalColdWater->plus($meter->totalReading),
                MeterType::HOT_WATER => $totalHotWater = $totalHotWater->plus($meter->totalReading),
            };

        }

        return [
            'totalHeating' => $totalHeating,
            'totalColdWater' => $totalColdWater,
            'totalHotWater' => $totalHotWater
        ];


    }

}
