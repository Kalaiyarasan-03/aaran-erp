<?php

namespace App\Enums;

enum Channels: int
{
    case SOFTWARE = 1;
    case ACCOUNTS = 2;
    case GST_FILLING = 3;
    case GST_AMENDMENT = 4;
    case LOAN_WORK = 5;
    case BANK_WORK = 6;
    case ALL = 7;

    public function getName(): string
    {
        return match ($this) {
            self::SOFTWARE => 'Software',
            self::ACCOUNTS => 'Accounts',
            self::GST_FILLING => 'Gst_filling',
            self::GST_AMENDMENT => 'Gst_amendment',
            self::BANK_WORK => 'Bank_work',
            self::LOAN_WORK => 'Loan_work',
            self::ALL => 'All_Channel',
        };
    }

}
