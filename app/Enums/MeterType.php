<?php

namespace App\Enums;

enum MeterType : string
{
    case HOT_WATER = 'hot_water';
    case COLD_WATER = 'cold_water';
    case HEATING = 'heating';

    public function label(): string
    {
        return __('meter_types.' . $this->value);
    }

    public static function options() : array
    {
        return array_map(
            fn(self $type) => [
                'value' => $type->value,
                'label' => $type->label()
            ],
            self::cases());
    }

}
