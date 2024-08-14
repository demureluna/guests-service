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
    public function getGuest(array $searchData): array;

    /**
     * Updating guest data in database
     *
     * @param array $guestData
     * @param array $updateData
     *
     * @return int
     */
    public function updateGuest(int $guestId, array $updateData): int;

    /**
     * Deleting guest from database
     *
     * @param int $guestId
     *
     * @return mixed
     */
    public function deleteGuest(int $guestId): int;
}