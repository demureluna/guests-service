<?php

declare(strict_types=1);

namespace GuestsService\Handler;

use GuestsService\Service\GuestsService;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Abstract handler class, implementing base handler logic
 */
abstract class BaseHandler implements RequestHandlerInterface
{
    /**
     * @var GuestsService $guestsService
     */
    protected GuestsService $guestsService;

    /**
     * Constructor
     *
     * @param GuestsService $guestsService
     */
    public function __construct(GuestsService $guestsService)
    {
        $this->guestsService = $guestsService;
    }

    /**
     * Handler
     *
     * @param ServerRequestInterface $request Instance of request
     *
     * @return ResponseInterface Server json response
     */
    abstract public function handle(ServerRequestInterface $request): ResponseInterface;
}