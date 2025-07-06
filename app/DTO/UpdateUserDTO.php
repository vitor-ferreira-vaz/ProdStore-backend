<?php

namespace App\DTO;

class UpdateUserDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $email
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            name: (string)$data['name'] ?? null,
            email: (string)$data['email'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

}
