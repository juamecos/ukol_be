<?php

require_once 'vendor/autoload.php';

use App\Router\Router;
use App\Controller\OrderController;

$router = new Router();

// Define your API routes
$router->get('/^\/(\d+)$/', function ($id) {
    $controller = new OrderController();
    $controller->getOrder($id);
});

// Resolve the request
$router->resolve();
