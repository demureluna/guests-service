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
class AddGuestHandler implements RequestHandlerInterface
{
    /**
     * @var GuestsService $guestsService
     */
    private GuestsService $guestsService;

    /**
     * Constructor
     *
     * @param GuestsService $guestsService
     */
    public function __construct($guestsService) {
        $this->guestsService = $guestsService;
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

        // try {
            $this->guestsService->addGuest($params);
            return new JsonResponse([
                'result' => 'Success'
            ]);
        // } catch (\Exception $e) {
        //     return new JsonResponse([
        //         'result' => 'Failed',
        //         'error' => 'An error occurred during execution. Check the entered data.'
        //     ]);
        // }
    }
}