<?php

declare(strict_types=1);

namespace GuestsService\Handler;

use Laminas\Diactoros\Response\JsonResponse;
use GuestsService\Service\GuestsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * A handler class, for handling authorization requests
 */
class GetGuestHandler implements RequestHandlerInterface
{
    /**
     * Constructor
     */
    public function __construct()
    {
        //
    }

    /**
     * Handler
     *
     * @param ServerRequestInterface $request Instance of request
     *
     * @return ResponseInterface Server json response
     */
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $params = $request->getParsedBody();



        return new JsonResponse([]);
    }
}