<?php

declare(strict_types=1);

namespace App\Helper;

use App\Exception\InvalidParameterException;
use Locale;

/**
 * Helper class to work with countries data
 */
class CountryHelper
{
    /**
     * Getting full country name by ICU code
     *
     * @param string $countryCode
     *
     * @return string
     * @throws InvalidParameterException
     */
    public static function getFullCountryNameByCode(string $countryCode): string
    {
        try {
            return Locale::getDisplayRegion($countryCode);
        } catch (\Exception $e) {
            throw new InvalidParameterException();
        }
    }
}