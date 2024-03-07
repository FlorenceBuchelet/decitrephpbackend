<?php

namespace Products;

class Cart
{
    private int $cartId;
    private int $userId;

    public function getCartId(): int
    {
        return $this->cartId;
    }
    public function setCartId(int $cartId): void
    {
        $this->cartId = $cartId;
    }
    public function getUserId(): int
    {
        return $this->userId;
    }
    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }
}
