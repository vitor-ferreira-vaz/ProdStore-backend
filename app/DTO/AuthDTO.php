<?php

namespace App\DTO;

use http\Env\Request;

class AuthDTO
{
    public function __construct(
        public readonly ?string $email,
        public readonly ?string $password
    ){}

    public static function fromArray(array $data): self
    {
        return new self(
            email: (string)$data['email'] ?? '',
            password: (string)$data['password'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'email' => $this->email,
            'password' => $this->password,
        ];
    }

}
