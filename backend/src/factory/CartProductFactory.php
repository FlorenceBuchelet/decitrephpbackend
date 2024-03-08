<?php

namespace Products;

use Products\CartProduct;

class CartProductFactory
{
    public static function createCartProductFromDatabase(
        int $productId,
        int $ean,
        string $title,
        string $author,
        string $image,
        float $price,
        int $categoryId,
        int $cartId,
    ): CartProduct {
        $cartProduct = new CartProduct();
        $cartProduct->setProductId($productId);
        $cartProduct->setEan($ean);
        $cartProduct->setTitle($title);
        $cartProduct->setImage($image);
        $cartProduct->setAuthor($author);
        $cartProduct->setPrice($price);
        $cartProduct->setCategoryId($categoryId);
        $cartProduct->setCartId($cartId);
        return $cartProduct;
    }
}
