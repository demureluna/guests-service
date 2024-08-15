<?php

use Phpmig\Adapter;

$container = new ArrayObject();

$config = [
    'driver' => 'mysql',
    'username' => getenv('MYSQL_USER') ?? '',
    'password' => getenv('MYSQL_PASSWORD') ?? '',
    'host' => getenv('MYSQL_HOST') ?? '',
    'database' => getenv('MYSQL_DATABASE') ?? '',
    'port' => getenv('MYSQL_PORT') ?? '3306',
    'charset' => getenv('MYSQL_CHARSET') ?? 'utf8',
    'collation' => getenv('MYSQL_COLLATION') ?? 'utf8_unicode_ci',
    'prefix' => '',
];

$capsule = new Illuminate\Database\Capsule\Manager();
$capsule->addConnection($config);
$capsule->setAsGlobal();

$capsule->bootEloquent();

$container['phpmig.adapter'] = new Adapter\File\Flat(__DIR__ . DIRECTORY_SEPARATOR . '../migrations/.migrations.log');
$container['phpmig.migrations_path'] = __DIR__ . DIRECTORY_SEPARATOR . '../migrations';

return $container;