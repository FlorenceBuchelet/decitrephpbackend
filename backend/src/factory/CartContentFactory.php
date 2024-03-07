<?php

namespace Products;

use Products\CartContent;

class CartContentFactory
{
    public static function createCartContentFromDatabase(
        int $cartContentId,
        int $cartId,
        int $productId,
    ): CartContent {
        $cartContent = new CartContent();
        $cartContent->setCartContentId($cartContentId);
        $cartContent->setCartId($cartId);
        $cartContent->setProductId($productId);
        return $cartContent;
    }
}
