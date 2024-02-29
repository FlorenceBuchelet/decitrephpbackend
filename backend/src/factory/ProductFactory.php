<?php

namespace Products;

use Products\Product;

// Factory : faire une fonction dans une classe pour concentrer les sources de données 
class ProductFactory
{
    public static function createProductFromDatabase(
        int $productId,
        int $ean,
        string $title,
        string $image,
        string $author,
        float $price,
        ?float $promoPrice
    ): Product {
        $product = new Product();
        $product->setProductId($productId);
        $product->setEan($ean);
        $product->setTitle($title);
        $product->setImage($image);
        $product->setAuthor($author);
        $product->setPrice($price);
        $product->setPromoPrice($promoPrice);

        return $product;
    }
}
