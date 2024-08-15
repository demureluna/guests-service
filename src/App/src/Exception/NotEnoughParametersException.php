<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constant\ErrorConstant;

/**
 * Exception class, calling when user isn't passing all required params to API
 */
class NotEnoughParametersException extends BaseException
{
    /**
     * Class constructor
     *
     * @param string $additionalMessage
     */
    public function __construct(string $additionalMessage = '')
    {
        parent::__construct(ErrorConstant::NOT_ENOUGH_PARAMS, $additionalMessage);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}