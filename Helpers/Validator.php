<?php

namespace App\Helpers;


class Validator
{
    public static function ip($ip): bool
    {
        $res = true;

        $numbers = explode('.', $ip);
        if (count($numbers) != 4) {
            return false;
        }

        foreach ($numbers as $number) {
            if (!is_numeric($number) || $number > 255 || $number < 0) {
                $res = false;
                break;
            }
        }

        return $res;
    }
}