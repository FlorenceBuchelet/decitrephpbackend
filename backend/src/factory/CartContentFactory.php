<?php

namespace Products;

use Products\CartContent;

class CartContentFactory
{
    public static function createCartContentFromDatabase(
        int $cartId,
        int $productId,
    ): CartContent {
        $cartContent = new CartContent();
        $cartContent->setCartId($cartId);
        $cartContent->setProductId($productId);
        return $cartContent;
    }
}
