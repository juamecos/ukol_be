<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Model\OrderItem;

require_once __DIR__ . '/../../../src/Model/OrderItem.php';

class OrderItemTest extends TestCase
{
    public function testOrderItemConstructor()
    {
        $orderItem = new OrderItem(1, 2, 3, 4, 10.00, 40.00);
        $this->assertInstanceOf(OrderItem::class, $orderItem);
        $this->assertEquals(1, $orderItem->getId());
        $this->assertEquals(2, $orderItem->getOrderId());
        $this->assertEquals(3, $orderItem->getProductId());
        $this->assertEquals(4, $orderItem->getQuantity());
        $this->assertEquals(10.00, $orderItem->getPrice());
        $this->assertEquals(40.00, $orderItem->getTotalPrice());
    }
}
