<?php

namespace App\Repositories\Eloquent;

use App\DTO\ProductDTO;
use App\Models\Product;
use App\Repositories\Contracts\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function list(): array
    {
        $obj_array = Product::all();
        if (!is_array($obj_array)){
            $obj_array = [];
        }
        return $obj_array;
    }
    public function store(ProductDTO $dto): ProductDTO
    {
        $insert = Product::create([$dto]);
        return $insert;
    }

    public function update(int $id, ProductDTO $dto): bool
    {
        $product = Product::find($id);
        $product->update([$dto]);
        return $product;
    }

    public function destroy(int $id): bool
    {
        return Product::destroy($id);
    }
}
