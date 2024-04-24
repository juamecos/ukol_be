<?php

namespace App\Model;

class OrderItem
{
    private int $id;
    private int $order_id;
    private int $product_id;
    private int $quantity;
    private float $price;
    private float $total_price;

    public function __construct(int $id, int $order_id, int $product_id, int $quantity, float $price, float $total_price) {
        $this->id = $id;
        $this->order_id = $order_id;
        $this->product_id = $product_id;
        $this->quantity = $quantity;
        $this->price = $price;
        $this->total_price = $total_price;
    }

    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setOrderId(int $order_id): void { $this->order_id = $order_id; }
    public function setProductId(int $product_id): void { $this->product_id = $product_id; }
    public function setQuantity(int $quantity): void { $this->quantity = $quantity; }
    public function setPrice(float $price): void { $this->price = $price; }
    public function setTotalPrice(float $total_price): void { $this->total_price = $total_price; }

    // Getters
    public function getId(): int { return $this->id; }
    public function getOrderId(): int { return $this->order_id; }
    public function getProductId(): int { return $this->product_id; }
    public function getQuantity(): int { return $this->quantity; }
    public function getPrice(): float { return $this->price; }
    public function getTotalPrice(): float { return $this->total_price; }
}


