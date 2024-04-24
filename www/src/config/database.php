<?php

require_once __DIR__ . '/vendor/autoload.php';


$dotenv = \Dotenv\Dotenv::createImmutable('./../config/');
$dotenv->load();

return [
    'mariadb' => [
        'host' => $_ENV['MYSQL_HOST'],
        'database' => $_ENV['MYSQL_DATABASE'],
        'user' => $_ENV['MYSQL_USER'],
        'password' => $_ENV['MYSQL_PASSWORD'],
        'charset' => $_ENV['MYSQL_CHARSET'],
        'options' => [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    ],
    // Other database configurations as needed
];