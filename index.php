<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

$router = require __DIR__ . '/app/Routes/routes.php';

$router->run();





