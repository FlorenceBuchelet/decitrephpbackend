<?php

namespace Products;

class CartProduct implements \JsonSerializable
{
    private int $productId;
    private int $ean;
    private string $title;
    private string $author;
    private string $image;
    private float $price;
    private ?float $promoPrice;
    private int $categoryId;
    private int $cartId;

    public function getProductId(): int
    {
        return $this->productId;
    }
    public function setProductId(int $productId): void
    {
        $this->productId = $productId;
    }

    public function getEan(): int
    {
        return $this->ean;
    }
    public function setEan(int $ean): void
    {
        $this->ean = $ean;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getImage(): string
    {
        return $this->image;
    }
    public function setImage(string $image): void
    {
        $this->image = $image;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    
    public function getPrice(): float
    {
        return $this->price;
    }
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }
    
    public function getPromoPrice(): ?float
    {
        return $this->promoPrice;
    }
    public function setPromoPrice(?float $promoPrice): void
    {
        $this->promoPrice = $promoPrice;
    }
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }
    public function setCategoryId(int $categoryId): void
    {
        $this->categoryId = $categoryId;
    }
    public function getCartId(): int
    {
        return $this->cartId;
    }
    public function setCartId(int $cartId): void
    {
        $this->cartId = $cartId;
    }
    public function jsonSerialize(): array
    {
        return [
            'productId' => $this->productId,
            'ean' => $this->ean,
            'title' => $this->title,
            'author' => $this->author,
            'image' => $this->image,
            'price' => $this->price,
            'promoPrice' => $this->promoPrice,
            'categoryId' => $this->categoryId,
            'cartId'=> $this->cartId,
        ];
    }
}
