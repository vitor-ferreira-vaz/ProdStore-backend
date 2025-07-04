<?php

namespace App\Repositories\Contracts;

use App\DTO\ProductDTO;

interface ProductRepositoryInterface
{
    public function list(): ? array;
    public function store(ProductDTO $dto): ?ProductDTO;

    public function update(int $id, ProductDTO $dto): bool;

    public function destroy(int $id): bool;

}
