<?php

declare(strict_types=1);

namespace App\Database\Interfaces;

use App\Exception\MySQLException;

/**
 * Interface for model entity (business-logic class)
 */
interface GuestsInterface
{
    /**
     * Inserting guest data into database
     *
     * @param array $guestData
     *
     * @return bool
     * @throws MySQLException
     */
    public function saveGuest(array $guestData): bool;

    /**
     * Getting guest data from database
     *
     * @param array $searchData
     *
     * @return array
     * @throws MySQLException
     */
    public function getGuest(array $searchData): array;

    /**
     * Updating guest data in database
     *
     * @param int $guestId
     * @param array $updateData
     *
     * @return int
     * @throws MySQLException
     */
    public function updateGuest(int $guestId, array $updateData): int;

    /**
     * Deleting guest from database
     *
     * @param int $guestId
     *
     * @return mixed
     * @throws MySQLException
     */
    public function deleteGuest(int $guestId): int;
}