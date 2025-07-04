<?php

namespace App\Services;

use App\Models\Product;
use App\DTO\ProductDTO;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $repository)
    {

    }

    public function store(array $data): ProductDTO
    {
        $dto = ProductDTO::fromArray($data);
        return $this->repository->store($dto);
    }

    public function update(int $id, array $data): bool
    {
        $dto = ProductDTO::fromArray($data);
        return $this->repository->update($id, $dto);
    }
    public function destroy(int $id): bool
    {
        return $this->repository->destroy($id);
    }

}
