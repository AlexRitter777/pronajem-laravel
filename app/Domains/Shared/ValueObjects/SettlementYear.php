<?php

declare(strict_types=1);

namespace App\Domains\Shared\ValueObjects;

use Carbon\CarbonImmutable;

final readonly class SettlementYear
{

    private function __construct(public int $year){}

    public static function fromInt(int $year) : self {

        if($year < 2000 || $year > 2100) {
            throw new \InvalidArgumentException('Year must be between 2000 and 2100');
        }

        return new self($year);
    }

    public function daysInYear() : int
    {
        return $this->isLeapYear() ? 366 : 365;
    }

    public function isLeapYear() : bool
    {
        return CarbonImmutable::create($this->year)->isLeapYear();
    }

    public function toInt() : int
    {
        return $this->year;
    }






}
