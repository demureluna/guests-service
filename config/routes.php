<?php

declare(strict_types=1);

use Mezzio\Application;

return static function (Application $app): void {
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

    $app->patch(
        '/api/guests/update',
        GuestsService\Handler\UpdateGuestHandler::class,
        'api.guests.update'
    );

    $app->delete(
        '/api/guests/delete',
        GuestsService\Handler\DeleteGuestHandler::class,
        'api.guests.delete'
    );
};
