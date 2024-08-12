<?php

declare(strict_types=1);

namespace GuestsService;

use GuestsService\Factory\AddGuestHandlerFactory;
use GuestsService\Handler\AddGuestHandler;

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
            ],
        ];
    }
}
