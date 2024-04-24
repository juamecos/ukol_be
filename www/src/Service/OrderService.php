<?php

namespace App\Service;

use App\Repository\OrderRepository;
use App\Repository\OrderItemRepository;

class OrderService {
    private $orderRepository;
    private $orderItemRepository;

    public function __construct() {
        // Initialize repositories
        $this->orderRepository = new OrderRepository('MariaDB');
        $this->orderItemRepository = new OrderItemRepository('MariaDB');
    }

    public function getOrderDetails($orderId) {
        try {
            // Retrieve the order by its ID
            $order = $this->orderRepository->findOneElement($orderId);
            if (!$order) {
                return ['error' => 'Order not found'];
            }

            // Retrieve all items associated with this order
            $items = $this->orderItemRepository->findElements(['order_id' => $orderId]);

            // Prepare the data to be returned
            $orderDetails = [
                'id' => $order->getId(),
                'customer_id' => $order->getCustomerId(),
                'creation_date' => $order->getCreationDate(),
                'total_amount' => $order->getTotalAmount(),
                'currency' => $order->getCurrency(),
                'status' => $order->getStatus(),
                'payment_type' => $order->getPaymentType(),
                'billing_address' => $order->getBillingAddress(),
                'shipping_address' => $order->getShippingAddress(),
                'items' => $items
            ];

            return $orderDetails;
        } catch (\Exception $e) {
            return ['error' => 'Failed to retrieve order details: ' . $e->getMessage()];
        }
    }
}
