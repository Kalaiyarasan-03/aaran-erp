<?php

namespace App\Enums;

enum ContactType: int
{
    case CREDITORS = 0;
    case DEBTORS = 1;

    public function getName(): string
    {
        return match ($this) {
            self::CREDITORS => 'Creditors',
            self::DEBTORS => 'Debtors',
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::CREDITORS => 'bg-red-500',
            self::DEBTORS => 'bg-green-500',
        };
    }

}
