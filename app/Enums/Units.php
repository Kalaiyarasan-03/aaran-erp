<?php

namespace App\Enums;

enum Units: int
{
    case KGS = 0;
    case MTS = 1;
    case PCS = 2;
    case NOS = 3;
    case LTS = 4;


    public function getName(): string
    {
        return match ($this) {
            self::KGS => 'Kgs',
            self::MTS => 'Mts',
            self::PCS => 'Pcs',
            self::NOS => 'Nos',
            self::LTS => 'Lts',
        };
    }

}
