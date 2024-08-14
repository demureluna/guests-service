<?php

declare(strict_types=1);

namespace GuestsService\Handler;

use App\Helper\JsonHelper;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use GuestsService\Service\GuestsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * A handler class, for handling authorization requests
 */
class DeleteGuestHandler extends BaseHandler implements RequestHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function __construct(GuestsService $guestsService)
    {
        parent::__construct($guestsService);
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();

        try {
            $response = $this->guestsService->deleteGuest($params);
            return new JsonResponse($response);
        } catch (Exception $e) {
            $response = JsonHelper::formatErrorResponse((string)$e->getCode(), $e->getMessage());
            return new JsonResponse($response);
        }
    }
}