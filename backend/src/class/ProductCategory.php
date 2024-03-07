<?php

namespace Products;

class ProductCategory
{
    private int $categoryId;
    private string $categoryName;

    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }
    public function getCategoryName(): string
    {
        return $this->categoryName;
    }
    public function setCategoryName(string $categoryName): void
    {
        $this->categoryName = $categoryName;
    }
}
