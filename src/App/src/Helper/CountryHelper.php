<?php

declare(strict_types=1);

namespace App\Helper;

use Locale;

/**
 * Helper class to work with countries
 */
class CountryHelper
{
    /**
     * Getting full country name by ICU code
     *
     * @param string $countryCode
     *
     * @return string
     */
    public static function getFullCountryNameByCode(string $countryCode): string
    {
        return Locale::getDisplayRegion($countryCode);
    }
}