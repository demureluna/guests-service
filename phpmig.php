<?php

use \Phpmig\Adapter;
use Symfony\Component\Dotenv\Dotenv;

$container = new ArrayObject();

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

$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection($config);
$capsule->setAsGlobal();

$capsule->bootEloquent();

$container['phpmig.adapter'] = new Adapter\File\Flat(__DIR__ . DIRECTORY_SEPARATOR . 'migrations/.migrations.log');
$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . 'migrations';

return $container;