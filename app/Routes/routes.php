<?php

use App\Controller\SearchController;
use Bramus\Router\Router;

$router = new Router();

$router->get('/suggest', function () {
    $controller = new SearchController();
    $controller->suggestCountries();
});

$router->get('/', function () {
    require __DIR__ . '/../Pages/search.php';
});

return $router;