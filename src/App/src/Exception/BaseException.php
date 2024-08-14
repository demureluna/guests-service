<?php
declare(strict_types=1);

namespace App\Exception;

use App\Constant\ResponseConstant;

class BaseException extends \Exception
{
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

    public function __toString(): string
    {
        return __CLASS__ . ": [$this->code]: $this->message\n";
    }
}