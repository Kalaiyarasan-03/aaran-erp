<?php

namespace App\Enums;

enum Status : int
{
    case NEW = 1;
    case PENDING = 2;
    case ONPROGRESS = 3;
    case NOTSTARTED = 4;
    case ARCHIVED = 5;
    case FINISHED = 6;
    case CLOSED = 7;
    case IMPORTANT = 8;
    case PRIORITY = 9;
    case TOPMOST = 10;
    case NOTACTIVE = 11;
    case RECEIVED = 12;
    case ADMINCLOSED = 100;

    public function getName(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::PENDING => 'Pending',
            self::ONPROGRESS => 'On Progress',
            self::NOTSTARTED => 'Notstarted',
            self::ARCHIVED => 'Archived',
            self::FINISHED => 'Finished',
            self::CLOSED => 'Closed',
            self::IMPORTANT => 'Important',
            self::PRIORITY => 'Priority',
            self::TOPMOST => 'Topmost',
            self::NOTACTIVE => 'NotActive',
            self::RECEIVED => 'Received',
            self::ADMINCLOSED => 'Admin Closed',
        };
    }

    public function getStyle(): string
    {
        return match ($this) {
            self::NEW => 'text-gray-500 bg-gray-300',
            self::PENDING => 'text-yellow-500 bg-gray-800',
            self::ONPROGRESS => 'text-blue-500 bg-blue-300',
            self::NOTSTARTED => 'text-gray-100 bg-gray-500',
            self::ARCHIVED => 'text-blue-800 bg-blue-200',
            self::FINISHED => 'text-green-800 bg-green-300',
            self::CLOSED => 'text-green-800 bg-green-400',
            self::IMPORTANT => 'text-yellow-700 bg-yellow-500',
            self::PRIORITY => 'text-pink-500 bg-pink-300',
            self::TOPMOST => 'text-red-700 bg-red-300',
            self::NOTACTIVE => 'text-red-400 bg-red-100',
            self::RECEIVED => 'text-white bg-green-600',
            self::ADMINCLOSED => 'text-purple-400 bg-purple-100',
        };
    }

}
