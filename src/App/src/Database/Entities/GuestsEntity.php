<?php

declare(strict_types=1);

namespace App\Database\Entities;

use App\Database\Interfaces\GuestsInterface;
use App\Database\Models\Guests;

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
        $this->model->name = $guestData['name'];
        $this->model->surname = $guestData['surname'];
        $this->model->email = $guestData['email'];
        $this->model->phone = $guestData['phone'];
        $this->model->country = $guestData['country'];
        
        return $this->model->save();
    }

    /**
     * @inheritDoc
     */
    public function getGuest(array $searchData): array
    {
        return $this->model->newQuery()
            ->where($searchData['field'], $searchData['value'])
            ->get()
            ->first()
            ->jsonSerialize();
    }

    /**
     * @inheritDoc
     */
    public function updateGuest(array $guestData, array $updateData): int
    {
        return $this->model->newQuery()
            ->where($guestData['field'], $guestData['value'])
            ->update($updateData);
    }

    /**
     * @inheritDoc
     */
    public function deleteGuest(array $guestData): int
    {
        return $this->model->newQuery()
            ->where($guestData['field'], $guestData['value'])
            ->delete();
    }
}