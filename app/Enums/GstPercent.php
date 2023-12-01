<?php

namespace App\Enums;

enum GstPercent: int
{
    case T1 = 0;
    case T5 = 1;
    case T12 = 2;
    case T18 = 3;
    case T24 = 4;


    public function getName(): string
    {
        return match ($this) {
            self::T1 => '0 %',
            self::T5 => '5 %',
            self::T12 => '12 %',
            self::T18 => '18 %',
            self::T24 => '24 %',
        };
    }

    public function getTax(): float
    {
        return match ($this) {
            self::T1 => 0,
            self::T5 => 5,
            self::T12 => 12,
            self::T18 => 18,
            self::T24 => 24,
        };
    }

}
