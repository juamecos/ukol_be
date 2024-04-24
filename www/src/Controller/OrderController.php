<?php

namespace App\Controller;



class OrderController extends BaseController {
    private $orderService;

    public function __construct() {
        $this->orderService = new \App\Service\OrderService();
    }

    // Method to handle the GET request to retrieve order data by identifier
    public function getOrder($identifier) {
        try {
            $orderDetails = $this->orderService->getOrderDetails($identifier);
            if (isset($orderDetails['error'])) {
                $this->jsonResponse(['error' => 'Order not found'], 404);
            } else {
                $this->jsonResponse($orderDetails, 200);
            }
        } catch (\Exception $e) {
            $this->jsonResponse(['error' => 'Server error: ' . $e->getMessage()], 500);
        }
    }
}