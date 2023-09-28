<?php

namespace App\Helper;

class ConvertTo
{
    public static function rupees(string $v): string
    {
        $explrestunits = "";
        $v = preg_replace('/,+/', '', $v);
        $words = explode(".", $v);
        $des = "00";
        if (count($words) <= 2) {
            $v = $words[0];
            if (count($words) >= 2) {
                $des = $words[1];
            }
            if (strlen($des) < 2) {
                $des = "$des";
            } else {
                $des = substr($des, 0, 2);
            }
        }
        if (strlen($v) > 3) {
            $lastthree = substr($v, strlen($v) - 3, strlen($v));
            $restunits = substr($v, 0, strlen($v) - 3); // extracts the last three digits
            $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
            $expunit = str_split($restunits, 2);
            for ($i = 0; $i < sizeof($expunit); $i++) {
                // creates each of the 2's group and adds a comma to the end
                if ($i == 0) {
                    $explrestunits .= (int)$expunit[$i] . ","; // if is first value , convert into integer
                } else {
                    $explrestunits .= $expunit[$i] . ",";
                }
            }
            $thecash = $explrestunits . $lastthree;
        } else {
            $thecash = $v;
        }
        return "₹ $thecash.$des"; // writes the final format where $currency is the currency symbol.
    }

    public static function decimal2($v):string
    {
        $arg = floatval($v);
        $arg = round($arg,2);
        return number_format($arg,2,'.','');
    }

    public static function decimal3($v):string
    {
        $arg = floatval($v);
        $arg = round($arg,3);
        return number_format($arg,3,'.','');
    }

    public static function thousandsSeparator($v):string
    {
        $arg = floatval($v);
        $arg = round($arg,2);
        return number_format($arg,2,'.',',');
    }

    public static function dateTime($v):string
    {
        return date('d-m-Y h:i:s a', strtotime($v));
    }

    public static function dateString($v):string
    {
        return date('d-m-Y', strtotime($v));
    }
}
