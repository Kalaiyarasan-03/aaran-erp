<?php

namespace App\Enums;

enum ProductType: int
{
    case GOODS = 0;
    case SERVICE = 1;


    public function getName(): string
    {
        return match ($this) {
            self::GOODS => 'Goods',
            self::SERVICE => 'Service',
        };
    }

}
