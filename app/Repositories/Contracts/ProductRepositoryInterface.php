<?php

namespace App\Repositories\Contracts;


use App\DTO\ProductDTO;
use Illuminate\Http\Request;

interface ProductRepositoryInterface
{
    public function all(Request $request): ?object;

    public function show(int $id): ?object;

//    public function fromEmail(string $email): ?object;

    public function store(ProductDTO $dto): ?array;

    public function update(int $id, ProductDTO $dto): array;

    public function destroy(int $id): array;

}
