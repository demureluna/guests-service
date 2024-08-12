<?php

declare(strict_types=1);

namespace GuestsService\Factory;

use App\Database\Entities\GuestsEntity;
use Psr\Container\ContainerInterface;
use GuestsService\Handler\AddGuestHandler;
use GuestsService\Service\GuestsService;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Factory, invoking AddGuestHandler
 */
class AddGuestHandlerFactory extends BaseFactory
{
    /**
     * @inheritdoc
     */
    public function __invoke(ContainerInterface $container): RequestHandlerInterface
    {
        parent::__invoke($container);

        $guestsEntity = new GuestsEntity();
        $guestsService = new GuestsService($guestsEntity);

        return new AddGuestHandler($guestsService);
    }
}