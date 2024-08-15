<?php

declare(strict_types=1);

namespace GuestsService\Factory;

use GuestsService\Handler\UpdateGuestHandler;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Factory, invoking AddGuestHandler
 */
class UpdateGuestHandlerFactory extends BaseFactory
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        parent::__invoke($container);

        return new UpdateGuestHandler($this->guestsService, $this->logger, $this->errorLogger);
    }
}