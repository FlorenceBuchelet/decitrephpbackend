<?php

namespace Products;

class CartContent
{
    private int $cartId;
    private int $productId;

    public function getCartId(): int
    {
        return $this->cartId;
    }
    public function setCartId(int $cartId): void
    {
        $this->cartId = $cartId;
    }
    public function getProductId(): int
    {
        return $this->productId;
    }
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }
}
