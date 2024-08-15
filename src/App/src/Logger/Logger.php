<?php

declare(strict_types=1);

namespace App\Logger;

use Monolog\Formatter\LineFormatter;
use Monolog\Level;
use Monolog\Logger as MonologLogger;
use Monolog\Handler\StreamHandler;

/**
 * Class, building logger instances
 */
class Logger
{
    /**
     * Setting logger to log requests
     *
     * @return MonologLogger Logger instance
     */
    public function getLogger(): MonologLogger
    {
        $logger = new MonologLogger('WebhooksLogger');

        $pathToLogs = $this->getPathToLogs('requests');
        $streamHandler = new StreamHandler(
            $pathToLogs,
            Level::Info
        );

        $formatter = new LineFormatter(
            "%level_name% | %datetime% -> %message% | %context%, %extra%\n",
            'd.m.Y',
            true,
            true
        );

        $streamHandler->setFormatter($formatter);
        $logger->pushHandler($streamHandler);

        return $logger;
    }

    /**
     * Setting logger to log errors
     *
     * @return MonologLogger Logger instance
     */
    public function getErrorLogger(): MonologLogger
    {
        $logger = new MonologLogger('WebhooksLogger');

        $pathToLogs = $this->getPathToLogs('error');
        $streamHandler = new StreamHandler(
            $pathToLogs,
            Level::Error
        );

        $formatter = new LineFormatter(
            "%level_name% | %datetime% -> %message% | %context%, %extra%\n",
            'd.m.Y',
            true,
            true
        );

        $streamHandler->setFormatter($formatter);
        $logger->pushHandler($streamHandler);

        return $logger;
    }

    /**
     * Iternal method, building route to log file
     *
     * @param string $level
     *
     * @return string
     */
    private function getPathToLogs(string $level): string
    {
        return sprintf(
            '%s%s%s%s%s',
            '/var/www/application/data/log/',
            date('d.m.Y'),
            '/',
            $level,
            '.log'
        );
    }
}
