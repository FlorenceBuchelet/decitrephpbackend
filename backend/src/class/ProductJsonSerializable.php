<?php 
class Product implements \JsonSerializable
{
    public function jsonSerialize(): array
    {
        return [
            'productId' => $this->productId,
            'ean' => $this->ean,
            'title' => $this->title,
            'image' => $this->image,
            'author' => $this->author,
            'price' => $this->price,
            'promoPrice' => $this->promoPrice,
        ];
    }
}