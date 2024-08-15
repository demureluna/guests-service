<?php

declare(strict_types=1);

namespace App\Constant;

/**
 * Constant storage class
 */
class ErrorConstant
{
    /**
     * @var string INVALID_PARAMETER_MESSAGE Error message
     */
    public const INVALID_PARAMETER_MESSAGE = 'One or more parameters passed to the request have not been validated and cannot be processed. Please check the input data again.';

    /**
     * @var string NOT_ENOUGH_PARAMS Error message
     */
    public const NOT_ENOUGH_PARAMS = 'Not all required parameters were passed to the request. Please check the input data again.';

    /**
     * @var string MYSQL_ERROR Error message
     */
    public const MYSQL_ERROR = 'An error occurred when sending a request to MySQL. Please check the input data.';
}
