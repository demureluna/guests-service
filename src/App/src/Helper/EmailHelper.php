<?php

declare(strict_types=1);

namespace App\Helper;

use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberUtil as Util;

/**
 * Helper class to work with countries
 */
class EmailHelper
{
    /**
     * Validating email format
     *
     * @param string $email
     *
     * @return string
     */
    public static function validateEmail(string $email): string
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }
}
