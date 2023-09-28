<?php

namespace App\Enums;

enum GST :int
{
    case IGST = 0;
    case CGST = 1;
    case SGST = 2;

    public function getName(): string
    {
        return match ($this) {
            self::IGST => 'IGST',
            self::CGST => 'CGST',
            self::SGST => 'SGST',
        };
    }
}
