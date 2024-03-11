<?php

namespace Products;

use Products\Product;

class ProductFactory
{
    public static function createProductFromDatabase(
        int $productId,
        int $ean,
        string $title,
        string $author,
        string $image,
        float $price,
        ?float $promoPrice,
        int $categoryId,
        int $quantity,
    ): Product {
        $product = new Product();
        $product->setProductId($productId);
        $product->setEan($ean);
        $product->setTitle($title);
        $product->setAuthor($author);
        $product->setImage($image);
        $product->setPrice($price);
        $product->setPromoPrice($promoPrice);
        $product->setCategoryId($categoryId);
        $product->setQuantity($quantity);
        return $product;
    }
}
