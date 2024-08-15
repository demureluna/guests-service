<?php

declare(strict_types=1);

namespace App\Helper;

use App\Constant\JsonConstant;
use App\Constant\ResponseConstant;

/**
 * Helper class to formatting Json responses
 */
class JsonHelper
{
    /**
     * Formatting received data into API response
     *
     * @param array $data
     *
     * @return array
     */
    public static function formatResponseWithData(array $data): array
    {
        return [
            'api_version' => JsonConstant::API_VERSION,
            'data' => [
                'id' => $data['id'] ?? null,
                'kind' => $data['kind'] ?? ResponseConstant::GUEST_KIND,
                'fields' => $data['fields'] ?? [],
                'items' => $data['items'],
            ],
        ];
    }

    /**
     * Formatting received data into API response
     *
     * @param array $data
     *
     * @return array
     */
    public static function formatDeleteResponse(array $data): array
    {
        return [
            'api_version' => JsonConstant::API_VERSION,
            'data' => [
                'id' => $data['id'] ?? null,
                'kind' => $data['kind'] ?? ResponseConstant::GUEST_KIND,
                'items' => [
                    'deleted' => true,
                ],
            ],
        ];
    }

    /**
     * Formatting received data into API response
     *
     * @param string $code
     * @param string $message
     *
     * @return array
     */
    public static function formatErrorResponse(string $code, string $message): array
    {
        return [
            'api_version' => JsonConstant::API_VERSION,
            'error' => [
                'code' => $code,
                'message' => $message,
            ],
        ];
    }
}
