<?php

declare(strict_types=1);

namespace App\Helper;

use App\Exception\InvalidParameterException;
use libphonenumber\PhoneNumberUtil as Util;

/**
 * Helper class to work with phones data
 */
class PhoneHelper
{
    /**
     * Validating phone format
     *
     * @param string $phone Phone number
     *
     * @return string
     * @throws InvalidParameterException
     */
    public static function validatePhone(string $phone): string
    {
        try {
            $phone = self::preparePhone($phone);
            $phonePattern = '~\b\d[- /\d]*\d\b~';

            $phoneUtil = Util::getInstance();
            $phoneNumber = $phoneUtil->parse($phone);

            if (
                (bool)preg_match($phonePattern, $phone) === true
                && $phoneUtil->isValidNumber($phoneNumber) === true
            ) {
                return self::formatPhone($phone);
            }
        } catch (\Exception $e) {
            throw new InvalidParameterException($e->getMessage());
        }

        return "Incorrect phone format";
    }

    /**
     * Getting region code by phone number
     *
     * @param string $phone Phone number
     *
     * @return string
     * @throws InvalidParameterException
     */
    public static function getRegionCodeByPhone(string $phone): string
    {
        try {
            $util = Util::getInstance();
            $phoneNumber = $util->parse($phone);

            return $util->getRegionCodeForNumber($phoneNumber);
        } catch (\Exception $e) {
            throw new InvalidParameterException($e->getMessage());
        }
    }

    /**
     * Preparing phone number from GET param
     *
     * @param string $phone
     *
     * @return string
     */
    public static function preparePhone(string $phone): string
    {
        $phone = trim($phone);
        if (mb_substr($phone, 0, 1) !== '+') {
            $phone = '+' . $phone;
        }

        return $phone;
    }

    /**
     * Formatting phone number to database format
     *
     * @param string $phone
     *
     * @return string
     */
    public static function formatPhone(string $phone): string
    {
        $formatPattern = '/[^0-9]/';
        $formattedPhone = preg_replace($formatPattern, '', $phone);

        return self::preparePhone($formattedPhone);
    }
}