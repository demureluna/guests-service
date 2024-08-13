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
class GetGuestHandler extends BaseHandler implements RequestHandlerInterface
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
     *
     * @throws NumberParseException
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getQueryParams();
        $guest = $this->guestsService->getGuest($params);

        return new JsonResponse(['guestData' => $guest]);
    }
}