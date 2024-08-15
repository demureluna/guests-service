<?php

declare(strict_types=1);

namespace App\Database\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model class for `guests` table
 *
 * @property int    $id
 * @property string $name
 * @property string $surname
 * @property string $email
 * @property string $phone
 * @property string $country
 */
class Guests extends Model
{
    /**
     * Table name, associated with the model
     *
     * @var string $table
     */
    protected $table = 'guests';
}