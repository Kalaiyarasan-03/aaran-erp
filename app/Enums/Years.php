<?php

namespace App\Enums;

enum Years: int
{
    case AY_2021 = 1;
    case AY_2022 = 2;
    case AY_2023 = 3;
    case AY_2024 = 4;
    case AY_2025 = 5;
    case AY_2026 = 6;
    case AY_2027 = 7;
    case AY_2028 = 8;
    case AY_2029 = 9;
    case AY_2030 = 10;

    public function getName(): string
    {
        return match ($this) {
            self::AY_2021 => '2021',
            self::AY_2022 => '2022',
            self::AY_2023 => '2023',
            self::AY_2024 => '2024',
            self::AY_2025 => '2025',
            self::AY_2026 => '2026',
            self::AY_2027 => '2027',
            self::AY_2028 => '2028',
            self::AY_2029 => '2029',
            self::AY_2030 => '2030',
        };
    }

}
