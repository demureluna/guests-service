<?php

declare(strict_types=1);

namespace GuestsService\Handler;

use GuestsService\Service\GuestsService;
use Monolog\Logger;
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
     * @var Logger $requestLogger
     */
    protected Logger $logger;

    /**
     * @var Logger $requestLogger
     */
    protected Logger $errorLogger;

    /**
     * Constructor
     *
     * @param GuestsService $guestsService
     * @param Logger $logger
     * @param Logger $errorLogger
     */
    public function __construct(
        GuestsService $guestsService,
        Logger $logger,
        Logger $errorLogger
    ) {
        $this->guestsService = $guestsService;
        $this->logger = $logger;
        $this->errorLogger = $errorLogger;
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