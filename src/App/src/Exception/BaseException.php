<?php

declare(strict_types=1);

namespace App\Exception;

use App\Constant\ResponseConstant;
use Exception;

/**
 * Exception class, that contains base methods
 */
class BaseException extends Exception
{
    /**
     * Class constructor
     *
     * @param string $mainMessage
     * @param string $additionalMessage
     */
    public function __construct(string $mainMessage, string $additionalMessage = '')
    {
        if (!empty($additionalMessage)) {
            $fullMessage = sprintf(
                '%s Message from handler: %s',
                $mainMessage,
                $additionalMessage
            );
        } else {
            $fullMessage = $mainMessage;
        }

        parent::__construct(
            $fullMessage,
            ResponseConstant::ERROR
        );
    }

    /**
     * Return exception message as string
     *
     * @return string
     */
    public function __toString(): string
    {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}