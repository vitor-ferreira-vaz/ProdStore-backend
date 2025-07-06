<?php

namespace App\Services;


use App\DTO\StoreUserDTO;
use App\DTO\UpdateUserDTO;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserService
{
    public function __construct(protected UserRepositoryInterface $repository) {}

    public function show(int $id): array
    {
        $obj = $this->repository->show($id);
        return [
            'status' => $obj ? 200 : 500,
            'message' => $obj ? 'Produto encontrado com sucesso!' : 'Produto não encontrado!',
            'data' => $obj ? : '',
        ];
    }

    public function store(array $data): array
    {
        $dto = StoreUserDTO::fromArray($data);
        $store = $this->repository->store($dto);
        return $store;
    }

    public function update(int $id, array $data): array
    {
        $dto = UpdateUserDTO::fromArray($data);
        $update = $this->repository->update($id, $dto);
        return $update;
    }
    public function destroy(int $id): array
    {
        $destroy = $this->repository->destroy($id);
        return $destroy;
    }

}
