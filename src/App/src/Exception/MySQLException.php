<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constant\ErrorConstant;

/**
 * Exception class, calling when MySQL request fails
 */
class MySQLException extends BaseException
{
    /**
     * Class constructor
     *
     * @param string $additionalMessage
     */
    public function __construct(string $additionalMessage = '')
    {
        parent::__construct(ErrorConstant::MYSQL_ERROR, $additionalMessage);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}