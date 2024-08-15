<?php

declare(strict_types=1);

namespace GuestsService\Service;

use App\Database\Entities\GuestsEntity;
use App\Exception\InvalidParameterException;
use App\Exception\MySQLException;
use App\Exception\NotEnoughParametersException;
use App\Helper\CountryHelper;
use App\Helper\EmailHelper;
use App\Helper\JsonHelper;
use App\Helper\PhoneHelper;

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
     * Class constructor
     *
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
     * @return array
     * @throws NotEnoughParametersException|MySQLException|InvalidParameterException
     */
    public function addGuest(array $requestData): array
    {
        if (
            !isset($requestData['name'])
            || !isset($requestData['surname'])
            || !isset($requestData['phone'])
        ) {
            throw new NotEnoughParametersException();
        }

        $phone = PhoneHelper::validatePhone($requestData['phone']);
        $email = isset($requestData['email'])
            ? EmailHelper::validateEmail($requestData['email'])
            : null;

        if (!isset($requestData['country'])) {
            $code = PhoneHelper::getRegionCodeByPhone($requestData['phone']);
            $country = CountryHelper::getFullCountryNameByCode($code);
        } else {
            $country = $requestData['country'];
        }

        $guestData = [
            'name' => $requestData['name'],
            'surname' => $requestData['surname'],
            'phone' => $phone,
            'email' => $email,
            'country' => $country,
        ];

        $result = $this->guestsEntity->saveGuest($guestData);

        if ($result) {
            $responseData = [
                'fields' => array_keys($guestData),
                'items' => $guestData,
            ];

            return JsonHelper::formatResponseWithData($responseData);
        } else {
            throw new InvalidParameterException();
        }
    }

    /**
     * Fetching guest from database
     *
     * @param array $guestInfo
     *
     * @return array|bool
     *
     * @throws InvalidParameterException
     * @throws NotEnoughParametersException
     * @throws MySQLException
     */
    public function getGuest(array $guestInfo): array|bool
    {
        $searchValue = $this->getSearchArray($guestInfo);
        $result = $this->guestsEntity->getGuest($searchValue);

        $responseData = [
            'fields' => array_keys($result),
            'id' => $result['id'],
            'items' => $result,
        ];

        return JsonHelper::formatResponseWithData($responseData);
    }

    /**
     * Updating guest in database
     *
     * @param array $guestInfo
     *
     * @return array
     * @throws InvalidParameterException|MySQLException
     */
    public function updateGuest(array $guestInfo): array
    {
        $updateData = [];
        $guestId = $guestInfo['id'] ?? null;
        unset($guestInfo['id']);

        foreach ($guestInfo as $key => $value) {
            if ($key == 'phone') {
                $phone = PhoneHelper::validatePhone($value);
                $updateData[$key] = $phone;
                continue;
            } elseif ($key == 'email') {
                $email = EmailHelper::validateEmail($value);
                $updateData[$key] = $email;
                continue;
            }

            $updateData[$key] = $value;
        }
        $result = $this->guestsEntity->updateGuest((int)$guestId, $updateData);

        if ((bool)$result) {
            $responseData = [
                'fields' => array_keys($updateData),
                'id' => $guestId,
                'items' => $updateData,
            ];

            return JsonHelper::formatResponseWithData($responseData);
        } else {
            throw new InvalidParameterException();
        }
    }

    /**
     * Deleting guest from database
     *
     * @param array $guestInfo
     *
     * @return array
     *
     * @throws InvalidParameterException
     * @throws MySQLException
     */
    public function deleteGuest(array $guestInfo): array
    {
        $searchValue = $guestInfo['id'] ?? null;
        $result = $this->guestsEntity->deleteGuest((int)$searchValue);

        if ((bool)$result) {
            $responseData = [
                'id' => $searchValue,
            ];

            return JsonHelper::formatDeleteResponse($responseData);
        } else {
            throw new InvalidParameterException();
        }
    }

    /**
     * Iternal method, building search array for fetching guest method
     *
     * @param array $guestInfo
     *
     * @return array
     *
     * @throws InvalidParameterException
     * @throws NotEnoughParametersException
     */
    private function getSearchArray(array $guestInfo): array
    {
        $searchValue = null;

        if (isset($guestInfo['phone'])) {
            $phone = PhoneHelper::validatePhone($guestInfo['phone']);

            $searchValue['field'] = 'phone';
            $searchValue['value'] = $phone;
        } elseif (isset($guestInfo['email'])) {
            $email = EmailHelper::validateEmail($guestInfo['email']);

            $searchValue['field'] = 'email';
            $searchValue['value'] = $email;
        } elseif (isset($guestInfo['id'])) {
            $searchValue['field'] = 'id';
            $searchValue['value'] = (int)$guestInfo['id'];
        } else {
            throw new NotEnoughParametersException();
        }

        return $searchValue;
    }
}