<?php

declare(strict_types=1);

namespace GuestsService;

use GuestsService\Factory\AddGuestHandlerFactory;
use GuestsService\Factory\DeleteGuestHandlerFactory;
use GuestsService\Factory\GetGuestHandlerFactory;
use GuestsService\Factory\UpdateGuestHandlerFactory;
use GuestsService\Handler\AddGuestHandler;
use GuestsService\Handler\DeleteGuestHandler;
use GuestsService\Handler\GetGuestHandler;
use GuestsService\Handler\UpdateGuestHandler;

/**
 * The configuration provider for the GuestsService module
 */
class ConfigProvider
{
    /**
     * Collecting all configuration data
     *
     * @return array[]
     */
    public function __invoke(): array
    {
        return [
            'dependencies' => $this->getDependencies(),
        ];
    }

    /**
     * Collecting all dependencies in module
     *
     * @return array[]
     */
    public function getDependencies(): array
    {
        return [
            'factories'  => [
                AddGuestHandler::class => AddGuestHandlerFactory::class,
                GetGuestHandler::class => GetGuestHandlerFactory::class,
                DeleteGuestHandler::class => DeleteGuestHandlerFactory::class,
                UpdateGuestHandler::class => UpdateGuestHandlerFactory::class,
            ],
        ];
    }
}
