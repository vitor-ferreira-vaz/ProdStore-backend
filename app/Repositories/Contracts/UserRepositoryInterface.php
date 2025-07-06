<?php

namespace App\Repositories\Contracts;


use App\DTO\StoreUserDTO;
use App\DTO\UpdateUserDTO;

interface UserRepositoryInterface
{
    public function show(int $id): ?object;

    public function fromEmail(string $email): ?object;

    public function store(StoreUserDTO $dto): ?array;

    public function update(int $id, UpdateUserDTO $dto): array;

    public function destroy(int $id): array;

}
