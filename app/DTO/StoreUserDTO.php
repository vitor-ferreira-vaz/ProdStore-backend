<?php

namespace App\DTO;

class StoreUserDTO
{
    public function __construct(
        public readonly ?string $name,
        public readonly ?string $email,
        public readonly ?string $password
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            name: (string)$data['name'] ?? null,
            email: (string)$data['email'] ?? '',
            password: (string)$data['password'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

}
