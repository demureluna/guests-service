<?php

declare(strict_types=1);

namespace GuestsService\Service;

use App\Database\Entities\GuestsEntity;
use App\Helper\CountryHelper;

/**
 * Service class to work with API users
 */
class GuestsService
{
    /** 
     * @var GuestsEntity $guestsEntity 
    */
    private $guestsEntity;

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
     */
    public function addGuest(array $requestData): bool
    {
        if (!isset($requestData['name']) || !isset($requestData['surname']) || !isset($requestData['phone'])) {
            return false;
        }
        
        if (!isset($requestData['country'])) {
            $requestData['country'] = CountryHelper::getCodeByPhone($requestData['phone']);
        }

        return $this->guestsEntity->saveGuest($requestData);
    }
}