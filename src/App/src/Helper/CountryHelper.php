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
     * Getting country code by phone number
     * 
     * @param string $phone Phone number
     * 
     * @return string
     * @throws NumberParseException
     */
    public static function getCodeByPhone(string $phone): string
    {
        $util = Util::getInstance();  
        $phoneNumber = $util->parse($phone);

        return $util->getRegionCodeForNumber($phoneNumber);
    }

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