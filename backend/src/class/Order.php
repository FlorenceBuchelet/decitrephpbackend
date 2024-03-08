<?php

namespace Products;

class Order
{
    private int $orderId;
    private int $userId;
    private int $cartId;
    private string $orderRef;
    private float $orderTotal;
    private int $orderAddressId;

    public function getOrderId(): int
    {
        return $this->orderId;
    }
    public function setOrderId(int $orderId): void
    {
        $this->orderId = $orderId;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
    public function getCartId(): int
    {
        return $this->cartId;
    }
    public function setCartId(int $cartId): void
    {
        $this->cartId = $cartId;
    }
    public function getOrderRef(): string
    {
        return $this->orderRef;
    }
    public function setOrderRef(string $orderRef): void
    {
        $this->orderRef = $orderRef;
    }
    public function getOrderTotal(): float
    {
        return $this->orderTotal;
    }
    public function setOrderTotal(float $orderTotal): void
    {
        $this->orderTotal = $orderTotal;
    }
    public function getOrderAddressId(): int
    {
        return $this->orderAddressId;
    }
    public function setOrderAddressId(int $orderAddressId): void
    {
        $this->orderAddressId = $orderAddressId;
    }
}
