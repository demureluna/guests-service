<?php

declare(strict_types=1);

namespace App\Database\Entities;

use App\Database\Interfaces\GuestsInterface;
use App\Database\Models\Guests;
use App\Exception\MySQLException;
use Exception;

/**
 * Class, that contains business-logic from model
 */
class GuestsEntity implements GuestsInterface
{
    /** 
     * @var Guests $model Instance of Tokens model 
    */
    private Guests $model;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->model = new Guests();
    }

    /**
     * @inheritDoc
     */
    public function saveGuest(array $guestData): bool
    {
        try {
            $this->model->name = $guestData['name'];
            $this->model->surname = $guestData['surname'];
            $this->model->email = $guestData['email'];
            $this->model->phone = $guestData['phone'];
            $this->model->country = $guestData['country'];

            return $this->model->save();
        } catch (Exception $e) {
            $errMessage = sprintf(
                'Perhaps such a guest already exists? MySQL error code: %s',
                $e->getCode()
            );
            throw new MySQLException($errMessage);
        }
    }

    /**
     * @inheritDoc
     */
    public function getGuest(array $searchData): array
    {
        $guestData = $this->model->newQuery()
            ->where($searchData['field'], $searchData['value'])
            ->get()
            ->first();

        if ($guestData !== null) {
            return $guestData->jsonSerialize();
        } else {
            $errMessage = 'Perhaps there is no such guest?';
            throw new MySQLException($errMessage);
        }
    }

    /**
     * @inheritDoc
     */
    public function updateGuest(int $guestId, array $updateData): int
    {
        try {
            return $this->model->newQuery()
                ->where('id', $guestId)
                ->update($updateData);
        } catch (Exception $e) {
            $errMessage = sprintf(
                'Perhaps you have entered incorrect fields? MySQL error code: %s',
                $e->getCode()
            );
            throw new MySQLException($errMessage);
        }
    }

    /**
     * @inheritDoc
     */
    public function deleteGuest(int $guestId): int
    {
        try {
            return $this->model->newQuery()
                ->where('id', $guestId)
                ->delete();
        } catch (Exception $e) {
            $errMessage = sprintf(
                'Perhaps you have entered incorrect fields? MySQL error code: %s',
                $e->getCode()
            );
            throw new MySQLException($errMessage);
        }
    }
}