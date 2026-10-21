<?php

use App\Config\Config;
use App\Controller\SearchController;
use App\Manticore\Manticore;
use Bramus\Router\Router;

$router = new Router();

$router->get('/suggest', function () {
    $config = new Config();
    $manticore = new Manticore($config);
    $controller = new SearchController($manticore);
    $controller->suggestCountries();
});

$router->get('/', function () {
    require_once __DIR__ . '/../Pages/search.html';
});

return $router;