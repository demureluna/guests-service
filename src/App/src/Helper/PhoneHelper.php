<?php

declare(strict_types=1);

namespace App\Helper;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil as Util;

/**
 * Helper class to work with countries
 */
class PhoneHelper
{
    /**
     * Validating phone format
     *
     * @param string $phone Phone number
     *
     * @return string
     */
    public static function validatePhoneFormat(string $phone): string
    {
        $phonePattern = '~\b\d[- /\d]*\d\b~';
        $phoneUtil = Util::getInstance();
        $phoneNumber = $phoneUtil->parse($phone);

        if (
            (bool)preg_match($phonePattern, $phone) === true
            && $phoneUtil->isValidNumber($phoneNumber) === true
        ) {
            $formatPattern = '/[^0-9]/';
            return preg_replace($formatPattern, '', $phoneNumber);
        }

        return "Incorrect phone format";
    }

    /**
     * Getting country code by phone number
     *
     * @param string $phone Phone number
     *
     * @return string
     * @throws NumberParseException
     */
    public static function getCountryCodeByPhone(string $phone): string
    {
        $util = Util::getInstance();
        $phoneNumber = $util->parse($phone);

        return $util->getRegionCodeForNumber($phoneNumber);
    }
}