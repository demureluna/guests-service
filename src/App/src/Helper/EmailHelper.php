<?php

declare(strict_types=1);

namespace App\Helper;

use App\Exception\InvalidParameterException;
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
        $filteredEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
        if (!$filteredEmail) {
            throw new InvalidParameterException();
        } else {
            return filter_var($email, FILTER_VALIDATE_EMAIL);
        }
    }
}
