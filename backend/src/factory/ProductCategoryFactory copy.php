<?php

namespace Products;

use Products\ProductCategory;

class ProductCategoryFactory
{
    public static function createProductCategoryFromDatabase(
        int $categoryId,
        string $categoryName,
    ): ProductCategory {
        $productCategory = new ProductCategory();
        $productCategory->setCategoryId($categoryId);
        $productCategory->setCategoryName($categoryName);
        return $productCategory;
    }
}
