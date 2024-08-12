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

        $config = [
            'driver' => 'mysql',
            'username' => $_ENV['MYSQL_USER'] ?? '',
            'password' => $_ENV['MYSQL_PASSWORD'] ?? '',
            'host' => $_ENV['MYSQL_HOST'] ?? '',
            'database' => $_ENV['MYSQL_DATABASE'] ?? '',
            'port' => $_ENV['MYSQL_PORT'] ?? 3306,
            'charset' => $_ENV['MYSQL_CHARSET'] ?? 'utf8',
            'collation' => $_ENV['MYSQL_COLLATION'] ?? 'utf8_unicode_ci',
            'prefix' => '',
        ];

        $capsule = new Manager();
        $capsule->addConnection($config);
        $capsule->setAsGlobal();
        $capsule->bootEloquent();
    }
}