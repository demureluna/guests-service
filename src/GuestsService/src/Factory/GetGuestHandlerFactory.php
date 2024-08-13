<?php

declare(strict_types=1);

namespace GuestsService\Factory;

use Psr\Container\ContainerInterface;
use GuestsService\Handler\GetGuestHandler;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Factory, invoking AddGuestHandler
 */
class GetGuestHandlerFactory extends BaseFactory
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        parent::__invoke($container);

        return new GetGuestHandler($this->guestsService);
    }
}