<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constant\ErrorConstant;

/**
 * Exception class, calling when user pass invalid params to API
 */
class InvalidParameterException extends BaseException
{
    /**
     * Class constructor
     *
     * @param string $additionalMessage
     */
    public function __construct(string $additionalMessage = '')
    {
        parent::__construct(ErrorConstant::INVALID_PARAMETER_MESSAGE, $additionalMessage);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}