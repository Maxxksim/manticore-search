<?php

declare(strict_types=1);

use Dotenv\Dotenv;

require_once __DIR__ . '/vendor/autoload.php';
$router = require __DIR__ . '/app/Routes/routes.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$router->run();





