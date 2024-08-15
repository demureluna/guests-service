<?php

declare(strict_types=1);

namespace App\Helper;

use App\Exception\InvalidParameterException;

/**
 * Helper class to work with email data
 */
class EmailHelper
{
    /**
     * Validating email format
     *
     * @param string $email
     *
     * @return string
     * @throws InvalidParameterException
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
