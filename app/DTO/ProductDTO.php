<?php

namespace App\DTO;

class ProductDTO
{
    public function __construct(
        public readonly ?string $id,
        public readonly ?string $title,
        public readonly ?string $price,
        public readonly ?string $description,
        public readonly ?string $category,
        public readonly ?string $image,
        public readonly ?float $rate
    )
    {

    }

    public static function InstancefromArray(array $data): self
    {
        /*
         * Sao muitos parametros para simplesmente instaciar new ProductDTO($id, $title, $price...)
         * então usamos o metodos estatico para criar uma instacia a partir de um array
        */
        return new self(
            id: (string)$data['id'] ?? null,
            title: (string)$data['title'] ?? '',
            price: (float)$data['price'] ?? '',
            description: (string)$data['description'] ?? '',
            category: (string)$data['category'] ?? '',
            image: (string)$data['image'] ?? '',
            rate: (float)$data['rate'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'price' => $this->price,
            'description' => $this->description,
            'category' => $this->category,
            'image' => $this->image,
            'rate' => $this->rate,
        ];
    }

}
