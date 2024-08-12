<?php

declare(strict_types=1);

namespace GuestsService\Factory;

use Psr\Container\ContainerInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Illuminate\Database\Capsule\Manager;
use Symfony\Component\Dotenv\Dotenv;

/**
 * Base class for factories
 */
abstract class BaseFactory
{
    /**
     * Factory invoker
     *
     * @param ContainerInterface $container DI container
     *
     * @return RequestHandlerInterface Instance of requests handling class
     */
    public function __invoke(ContainerInterface $container)
    {
        $env = new Dotenv();
        $env->load('/var/www/application/.env');

        $config = $container->get('config');

        $capsule = new Manager();
        $capsule->addConnection($config['database']);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}