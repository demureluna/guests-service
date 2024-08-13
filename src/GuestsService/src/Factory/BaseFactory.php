<?php

declare(strict_types=1);

namespace GuestsService\Factory;

use App\Database\Entities\GuestsEntity;
use GuestsService\Service\GuestsService;
use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Illuminate\Database\Capsule\Manager;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Base class for factories
 */
abstract class BaseFactory
{
    protected GuestsEntity $guestsEntity;

    protected GuestsService $guestsService;

    /**
     * Factory invoker
     *
     * @param ContainerInterface $container DI container
     *
     * @return RequestHandlerInterface Instance of requests handling class
     */
    public function __invoke(ContainerInterface $container)
    {
        $config = $container->get('config');

        $capsule = new Manager();
        $capsule->addConnection($config['database']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();

        $this->guestsEntity = new GuestsEntity();
        $this->guestsService = new GuestsService($this->guestsEntity);
    }
}