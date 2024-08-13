<?php

declare(strict_types=1);

namespace GuestsService\Service;

use App\Database\Entities\GuestsEntity;
use App\Helper\CountryHelper;
use App\Helper\EmailHelper;
use App\Helper\PhoneHelper;
use libphonenumber\NumberParseException;

/**
 * Service class to work with API users
 */
class GuestsService
{
    /** 
     * @var GuestsEntity $guestsEntity 
    */
    private GuestsEntity $guestsEntity;

    /**
     * @param GuestsEntity $guestsEntity
     */
    public function __construct(GuestsEntity $guestsEntity)
    {
        $this->guestsEntity = $guestsEntity;
    }

    /**
     * Saving guest to database
     *
     * @param array $requestData Guest data form request
     *
     * @return bool
     * @throws NumberParseException
     */
    public function addGuest(array $requestData): bool
    {
        if (!isset($requestData['name']) || !isset($requestData['surname']) || !isset($requestData['phone'])) {
            return false;
        }

        if (!isset($requestData['country'])) {
            $code = PhoneHelper::getRegionCodeByPhone($requestData['phone']);
            $country = CountryHelper::getFullCountryNameByCode($code);
        } else {
            $country = $requestData['country'];
        }

        $phone = PhoneHelper::validatePhone($requestData['phone']);
        $email = isset($requestData['email'])
            ? EmailHelper::validateEmail($requestData['email'])
            : null;

        $guestData = [
            'name' => $requestData['name'],
            'surname' => $requestData['surname'],
            'phone' => $phone,
            'email' => $email,
            'country' => $country,
        ];

        return $this->guestsEntity->saveGuest($guestData);
    }

    /**
     * @param array $guestInfo
     *
     * @return array|bool
     * @throws NumberParseException
     */
    public function getGuest(array $guestInfo): array|bool
    {
        $searchValue = [];

        if (isset($guestInfo['phone'])) {
            $phone = PhoneHelper::validatePhone($guestInfo['phone']);

            $searchValue['field'] = 'phone';
            $searchValue['value'] = $phone;
        } elseif (isset($guestInfo['email'])) {
            $email = EmailHelper::validateEmail($guestInfo['email']);

            $searchValue['field'] = 'email';
            $searchValue['value'] = $email;
        } else {
            return false;
        }

        return $this->guestsEntity->getGuest($searchValue);
    }
}