<?php
declare(strict_types=1);

namespace App\Exception;

use App\Constant\ErrorConstant;

class InvalidParameterException extends BaseException
{
    public function __construct(string $additionalMessage = '')
    {
        parent::__construct(ErrorConstant::INVALID_PARAMETER_MESSAGE, $additionalMessage);
    }

    public function __toString(): string
    {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}