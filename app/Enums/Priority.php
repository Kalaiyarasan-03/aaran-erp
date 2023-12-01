<?php

namespace App\Enums;

enum Priority :int
{
    case IMPORTANT = 0;
    case MOST_IMPORTANT = 1;
    case URGENT = 3;
    case MOST_URGENT = 4;
    case NORMAL = 5;


    public function getName(): string
    {
        return match ($this) {
            self::IMPORTANT => 'Important',
            self::MOST_IMPORTANT => 'Most Important',
            self::URGENT => 'Urgent',
            self::MOST_URGENT => 'Most Urgent',
            self::NORMAL => 'Normal',
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::IMPORTANT => 'bg-yellow-400',
            self::MOST_IMPORTANT => 'bg-green-500',
            self::URGENT => 'bg-red-300',
            self::MOST_URGENT => 'bg-red-500',
            self::NORMAL => 'bg-gray-300',
        };
    }

}
