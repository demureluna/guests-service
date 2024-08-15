<?php

declare(strict_types=1);

namespace App\Constant;

/**
 * Constant storage class
 */
class ResponseConstant
{
    /**
     * @var int SUCCESS Success status code
     */
    public const SUCCESS = 200;

    /**
     * @var int NO_CONTENT Success status code
     */
    public const NO_CONTENT = 204;

    /**
     * @var int ERROR Error status code
     */
    public const ERROR = 400;

    /**
     * @var string GUEST_KIND Kind of data to pass to API
     */
    public const GUEST_KIND = 'guest';
}
