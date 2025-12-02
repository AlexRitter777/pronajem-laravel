<?php

namespace App\Traits;

trait FormatsMoney
{

    public function formatMoney(?int $value, string $currency = 'EUR'): ?string
    {
        if ($value === null) {
            return null;
        }

        return number_format($value, 0, ',', ' ') . ' ' . $currency;
    }

}
