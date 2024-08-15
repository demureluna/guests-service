<?php

declare(strict_types=1);

namespace GuestsService\Factory;

use App\Database\Entities\GuestsEntity;
use App\Logger\Logger;
use GuestsService\Service\GuestsService;
use Monolog\Logger as MonologLogger;
use Psr\Container\ContainerInterface;
use Illuminate\Database\Capsule\Manager;

/**
 * Factories class, that contains all base methods and properties
 */
class BaseFactory
{
    /**
     * @var GuestsEntity $guestsEntity
     */
    protected GuestsEntity $guestsEntity;

    /**
     * @var GuestsService $guestsService
     */
    protected GuestsService $guestsService;

    /**
     * @var MonologLogger $logger
     */
    protected MonologLogger $logger;

    /**
     * @var MonologLogger $errorLogger
     */
    protected MonologLogger $errorLogger;

    /**
     * Factory invoker
     *
     * @param ContainerInterface $container DI container
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

        $logger = new Logger();
        $this->logger = $logger->getLogger();
        $this->errorLogger = $logger->getErrorLogger();
    }
}