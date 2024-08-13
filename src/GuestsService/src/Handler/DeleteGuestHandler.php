<?php

declare(strict_types=1);

namespace GuestsService\Handler;

use App\Helper\PhoneHelper;
use Laminas\Diactoros\Response\JsonResponse;
use GuestsService\Service\GuestsService;
use libphonenumber\NumberParseException;
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
            $this->guestsService->deleteGuest($params);
            return new JsonResponse([
                'result' => 'Success'
            ]);
        } catch (\Exception $e) {
            return new JsonResponse([
                'result' => 'Failed',
                'error' => 'An error occurred during execution. Check the entered data.'
            ]);
        }
    }
}