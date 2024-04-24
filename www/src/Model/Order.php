<?php

namespace App\Model;

class Order
{
    private int $id;
    private int $customer_id;
    private \DateTime $creation_date;
    private float $total_amount;
    private string $currency;
    private string $status;
    private string $payment_type;
    private string $billing_address;
    private string $shipping_address;
    private array $items = [];

    public function __construct(int $id, int $customer_id, \DateTime $creation_date, float $total_amount, string $currency, string $status, string $payment_type, string $billing_address, string $shipping_address)
    {
        $this->id = $id;
        $this->customer_id = $customer_id;
        $this->creation_date = $creation_date;
        $this->total_amount = $total_amount;
        $this->currency = $currency;
        $this->status = $status;
        $this->payment_type = $payment_type;
        $this->billing_address = $billing_address;
        $this->shipping_address = $shipping_address;
    }

    // Setters
    public function setId(int $id): void { $this->id = $id; }
    public function setCustomerId(int $customer_id): void { $this->customer_id = $customer_id; }
    public function setCreationDate(\DateTime $creation_date): void { $this->creation_date = $creation_date; }
    public function setTotalAmount(float $total_amount): void { $this->total_amount = $total_amount; }
    public function setCurrency(string $currency): void { $this->currency = $currency; }
    public function setStatus(string $status): void { $this->status = $status; }
    public function setPaymentType(string $payment_type): void { $this->payment_type = $payment_type; }
    public function setBillingAddress(string $billing_address): void { $this->billing_address = $billing_address; }
    public function setShippingAddress(string $shipping_address): void { $this->shipping_address = $shipping_address; }

    // Getters
    public function getId(): int { return $this->id; }
    public function getCustomerId(): int { return $this->customer_id; }
    public function getCreationDate(): \DateTime { return $this->creation_date; }
    public function getTotalAmount(): float { return $this->total_amount; }
    public function getCurrency(): string { return $this->currency; }
    public function getStatus(): string { return $this->status; }
    public function getPaymentType(): string { return $this->payment_type; }
    public function getBillingAddress(): string { return $this->billing_address; }
    public function getShippingAddress(): string { return $this->shipping_address; }

    // Items relationship
    public function addItem(OrderItem $item): void {
        $this->items[] = $item;
    }

    public function getItems(): array {
        return $this->items;
    }
}

