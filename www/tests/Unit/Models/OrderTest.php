<?php

namespace Tests\Unit\Models;

use PHPUnit\Framework\TestCase;
use App\Model\Order;
use DateTime;

require_once __DIR__ . '/../../../src/Model/Order.php';


class OrderTest extends TestCase
{
    private $order;

    protected function setUp(): void
    {
        $this->order = new Order(
            1,
            100,
            new DateTime('2020-01-01'),
            250.00,
            'USD',
            'completed',
            'Credit Card',
            '123 Billing St',
            '321 Shipping St'
        );
    }

    public function testClassConstructor()
    {
        $this->assertInstanceOf(Order::class, $this->order);
        $this->assertEquals(1, $this->order->getId());
        $this->assertEquals(100, $this->order->getCustomerId());
        $this->assertEquals(new DateTime('2020-01-01'), $this->order->getCreationDate());
        $this->assertEquals(250.00, $this->order->getTotalAmount());
        $this->assertEquals('USD', $this->order->getCurrency());
        $this->assertEquals('completed', $this->order->getStatus());
        $this->assertEquals('Credit Card', $this->order->getPaymentType());
        $this->assertEquals('123 Billing St', $this->order->getBillingAddress());
        $this->assertEquals('321 Shipping St', $this->order->getShippingAddress());
    }
}
