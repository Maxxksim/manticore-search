<?php

use App\Config\Config;
use App\Controller\SearchController;
use App\Database\Db;
use App\Manticore\Manticore;
use Bramus\Router\Router;

$router = new Router();
$config = new Config();
new Db($config);
$manticore = new Manticore($config);
$controller = new SearchController($manticore);

$router->get('/', function () {
    require_once __DIR__ . '/../Pages/search.html';
});

$router->get('/suggest', function () use ($controller) {
    $controller->suggestCountries();
});

$router->get('/search', function () use ($controller) {
    $controller->searchCountryInfo();
});

return $router;