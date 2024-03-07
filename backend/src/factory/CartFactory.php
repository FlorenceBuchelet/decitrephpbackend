<?php

namespace Products;

use Products\Cart;

class CartFactory
{
    public static function createCartFromDatabase(
        int $cartId,
        int $userId,
    ): Cart {
        $cart = new Cart();
        $cart->setCartId($cartId);
        $cart->setUserId($userId);
        return $cart;
    }
}
