<?php

namespace App\Services;


use App\DTO\ProductDTO;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Eloquent\ProductRepository;
use Illuminate\Http\Request;

class ProductService
{
    public function __construct(protected ProductRepositoryInterface $repository)
    {
    }

    public function list(Request $request): array
    {
        $obj = $this->repository->all($request);
        return [
            'status' => $obj ? 200 : 500,
            'message' => $obj ? 'Produto encontrado com sucesso!' : 'Produto não encontrado!',
            'data' => $obj ?: '',
        ];
    }

    public function show(int $id): array
    {
        $obj = $this->repository->show($id);
        return [
            'status' => $obj ? 200 : 500,
            'message' => $obj ? 'Produto encontrado com sucesso!' : 'Produto não encontrado!',
            'data' => $obj ?: '',
        ];
    }

    public function store(array $data): array
    {
        $dto = ProductDTO::InstancefromArray($data);
        $store = $this->repository->store($dto);
        return $store;
    }

    public function update(int $id, array $data): array
    {
        $dto = ProductDTO::InstancefromArray($data);
        $update = $this->repository->update($id, $dto);
        return $update;
    }

    public function destroy(int $id): array
    {
        $destroy = $this->repository->destroy($id);
        return $destroy;
    }

}
