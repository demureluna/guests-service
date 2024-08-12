<?php

declare(strict_types=1);

namespace App\Helper;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil as Util;

/**
 * Helper class to work with countries
 */
class CountryHelper
{
    /**
     * Getting full country name by ICU code
     * 
     * @param string $code ICU country code
     * 
     * @return string
     */
    public static function getFullCountryNameByCode(string $code): string
    {
        return \Locale::getDisplayRegion($code);
    }
}