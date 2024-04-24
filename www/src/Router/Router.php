<?php

namespace App\Router;

use App\Controller\OrderController;

class Router {
    public $routes = [];

    public function __construct() {
        $this->routes = [
            'GET' => [],
            'POST' => [],
            'PUT' => [],
            'DELETE' => []
        ];
    }

    public function get($path, $callback) {
        $this->routes['GET'][$path] = $callback;
    }

    public function resolve() {
        $requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes[$requestMethod] as $path => $callback) {
            if (preg_match($path, $requestUri, $matches)) {
                array_shift($matches); // Remove the full match
                call_user_func_array($callback, $matches);
                return;
            }
        }

        header("HTTP/1.1 404 Not Found");
        echo json_encode(['error' => 'Endpoint not found']);
        exit;
    }
}

