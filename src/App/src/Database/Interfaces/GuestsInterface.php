<?php

declare(strict_types=1);

namespace App\Database\Interfaces;

interface GuestsInterface
{
    /**
     * Inserting guest data into database
     *
     * @param array $guestData
     *
     * @return bool
     */
    public function saveGuest(array $guestData): bool;

    /**
     * Getting guest data from database
     *
     * @param string $email
     *
     * @return array
     */
    public function getGuest(string $email): array;

    /**
     * Updating guest data in database
     *
     * @param string $guestData
     * @param array $updateData
     *
     * @return array
     */
    public function updateGuest(string $guestData, array $updateData): int;

    /**
     * Deleting guest from database
     *
     * @param string $guestData
     *
     * @return mixed
     */
    public function deleteGuest(string $guestData): array;
}