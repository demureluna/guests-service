<?php

declare(strict_types=1);

use Mezzio\Application;
use Mezzio\MiddlewareFactory;
use Psr\Container\ContainerInterface;

return static function (Application $app, MiddlewareFactory $factory, ContainerInterface $container): void {
    $app->post(
        '/api/guests/add',
        GuestsService\Handler\AddGuestHandler::class,
        'api.guests.add'
    );

    $app->get(
        '/api/guests/get',
        GuestsService\Handler\GetGuestHandler::class,
        'api.guests.get'
    );
};
