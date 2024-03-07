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
        int $categoryId,
    ): Product {
        $product = new Product();
        $product->setProductId($productId);
        $product->setEan($ean);
        $product->setTitle($title);
        $product->setImage($image);
        $product->setAuthor($author);
        $product->setPrice($price);
        $product->setCategoryId($categoryId);
        return $product;
    }
}
