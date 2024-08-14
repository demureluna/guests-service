<?php
declare(strict_types=1);

namespace App\Exception;

use App\Constant\ErrorConstant;

class MySQLException extends BaseException
{
    public function __construct(string $additionalMessage = '')
    {
        parent::__construct(ErrorConstant::MYSQL_ERROR, $additionalMessage);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}