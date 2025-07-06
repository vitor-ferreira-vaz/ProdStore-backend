<?php

namespace App\DTO;

class ResetPasswordDTO
{
    public function __construct(
        public readonly ?string $password,
        public readonly ?string $token,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            password: (string)$data['password'] ?? null,
            token: (string)$data['token'] ?? '',
        );
    }

    public function toArray(): array
    {
        return [
            'password' => $this->password,
            'token' => $this->token,
        ];
    }

}
