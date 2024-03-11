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
        ?float $promoPrice,
        int $categoryId,
        int $cartId,
    ): CartProduct {
        $cartProduct = new CartProduct();
        $cartProduct->setProductId($productId);
        $cartProduct->setEan($ean);
        $cartProduct->setTitle($title);
        $cartProduct->setAuthor($author);
        $cartProduct->setImage($image);
        $cartProduct->setPrice($price);
        $cartProduct->setPromoPrice($promoPrice);
        $cartProduct->setCategoryId($categoryId);
        $cartProduct->setCartId($cartId);
        return $cartProduct;
    }
}
