<?php

namespace App\Support;

use DateTime;

class Helpers
{
    public static function removeSpecials(?string $string)
    {
        return preg_replace('/[^A-Za-z0-9à-úÀ-Ú]/', '', $string);
    }

    public static function formatPhone($phone)
    {
        $formatedPhone = preg_replace('/[^0-9]/', '', $phone);
        $matches = [];
        preg_match('/^([0-9]{2})([0-9]{4,5})([0-9]{4})$/', $formatedPhone, $matches);
        if ($matches) {
            return '(' . $matches[1] . ') ' . $matches[2] . '-' . $matches[3];
        }

        return $phone;
    }

    public static function format_date(DateTime $date, $format = 'd/m/Y')
    {
        return $date->format($format);
    }
}
