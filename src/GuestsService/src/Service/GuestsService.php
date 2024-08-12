<?php

declare(strict_types=1);

namespace GuestsService\Service;

use App\Database\Entities\GuestsEntity;
use App\Helper\CountryHelper;
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
        $code = CountryHelper::getCodeByPhone($requestData['phone']);

        if (!isset($requestData['name']) || !isset($requestData['surname']) || !isset($requestData['phone'])) {
            return false;
        }
        
        if (!isset($requestData['country'])) {
            $requestData['country'] = PhoneHelper::getCountryCodeByPhone($requestData['phone']);
        }

        return $this->guestsEntity->saveGuest($requestData);
    }

    /**
     * @param string $guestInfo
     *
     * @return array
     */
    public function getGuest(string $guestInfo): array
    {


        return array();
    }
}