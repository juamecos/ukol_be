<?php

namespace App\Controller;

abstract class BaseController {
    // This method can be used to send JSON responses
    protected function jsonResponse($data, $statusCode = 200) {
        header('Content-Type: application/json');
        http_response_code($statusCode);
        echo json_encode($data);
        exit;
    }
}