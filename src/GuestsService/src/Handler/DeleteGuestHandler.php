<?php

declare(strict_types=1);

namespace GuestsService\Handler;

use App\Helper\JsonHelper;
use Exception;
use Laminas\Diactoros\Response\JsonResponse;
use GuestsService\Service\GuestsService;
use Monolog\Logger;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * A handler class, for DeleteGuest API request
 */
class DeleteGuestHandler extends BaseHandler implements RequestHandlerInterface
{
    /**
     * @inheritDoc
     */
    public function __construct(
        GuestsService $guestsService,
        Logger $logger,
        Logger $errorLogger
    ) {
        parent::__construct($guestsService, $logger, $errorLogger);
    }

    /**
     * @inheritDoc
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();

        try {
            $response = $this->guestsService->deleteGuest($params);
            $this->logger->info('Detected request!', $response);

            return new JsonResponse($response);
        } catch (Exception $e) {
            $response = JsonHelper::formatErrorResponse((string)$e->getCode(), $e->getMessage());
            $this->errorLogger->error('An error occurred while deleting guest!', $response);

            return new JsonResponse($response);
        }
    }
}