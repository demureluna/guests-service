<?php

declare(strict_types=1);

namespace GuestsService\Factory;

use GuestsService\Handler\DeleteGuestHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Factory, invoking AddGuestHandler
 */
class DeleteGuestHandlerFactory extends BaseFactory
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        parent::__invoke($container);

        return new DeleteGuestHandler($this->guestsService, $this->logger, $this->errorLogger);
    }
}