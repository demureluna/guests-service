<?php

declare(strict_types=1);

use Symfony\Component\Dotenv\Dotenv;

$env = new Dotenv();
$env->load('/var/www/application/.env');

return [
    'database' => [
        'driver' => 'mysql',
        'username' => $_ENV['MYSQL_USER'] ?? '',
        'password' => $_ENV['MYSQL_PASSWORD'] ?? '',
        'host' => $_ENV['MYSQL_HOST'] ?? '',
        'database' => $_ENV['MYSQL_DATABASE'] ?? '',
        'port' => $_ENV['MYSQL_PORT'] ?? '3306',
        'charset' => $_ENV['MYSQL_CHARSET'] ?? 'utf8',
        'collation' => $_ENV['MYSQL_COLLATION'] ?? 'utf8_unicode_ci',
        'prefix' => '',
    ],
];