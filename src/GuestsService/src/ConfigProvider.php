<?php

declare(strict_types=1);

namespace GuestsService;

use GuestsService\Factory\AddGuestHandlerFactory;
use GuestsService\Factory\GetGuestHandlerFactory;
use GuestsService\Handler\AddGuestHandler;
use GuestsService\Handler\GetGuestHandler;

class ConfigProvider
{
    /**
     * @return array
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Returns the container dependencies
     */
    public function getDependencies(): array
    {
        return [
            'factories'  => [
                AddGuestHandler::class => AddGuestHandlerFactory::class,
                GetGuestHandler::class => GetGuestHandlerFactory::class,
            ],
        ];
    }
}
