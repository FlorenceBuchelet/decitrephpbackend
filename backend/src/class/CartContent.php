<?php

namespace Products;

class CartContent
{
    private int $cartContentId;
    private int $cartId;
    private int $productId;
    public function getCartContentId(): int
    {
        return $this->cartContentId;
    }
    public function setCartContentId(int $cartContentId): void
    {
        $this->cartContentId = $cartContentId;
    }

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
