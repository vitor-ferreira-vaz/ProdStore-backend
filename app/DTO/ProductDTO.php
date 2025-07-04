<?php

namespace App\DTO;

class ProductDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $category,
        public readonly ?bool $with_image,
        public readonly ?int $id
    )
    {

    }

    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'] ?? null,
            $data['category'] ?? '',
            $data['with_image'] ?? '',
            $data['id'] ?? '',
        );
    }

}
