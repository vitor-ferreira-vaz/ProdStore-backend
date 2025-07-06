<?php

namespace App\Repositories\Eloquent;

use App\DTO\StoreUserDTO;
use App\DTO\UpdateUserDTO;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;

class UserRepository implements UserRepositoryInterface
{
    public function show(int $id): object
    {
        return User::find($id);
    }

    public function fromEmail(string $email): object
    {
        return User::whereRaw("email = '$email'")->first();
    }

    public function store(StoreUserDTO $dto): array
    {
        DB::beginTransaction();
        try {
            User::create($dto->toArray());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack(); $name= $dto->name;
            return [
                'status' => 500,
                'message' => "Erro ao cadastrar: {$e->getMessage()}",
            ];
        }
        return [
            'status' => 200,
            'message' => "Cadastrado com sucesso!",
        ];
    }

    public function update(int $id, UpdateUserDTO $dto): array
    {
        DB::beginTransaction();
        try {
            $product = User::find($id);
            $product->update($dto->toArray());
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => "Erro ao cadastrar:  {$e->getMessage()}",
            ];
        }
        return [
            'status' => 200,
            'message' => "Atualizado com sucesso!",
        ];
    }

    public function destroy(int $id): array
    {
        DB::beginTransaction();
        try {
            User::destroy($id);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return [
                'status' => 500,
                'message' => "Erro ao cadastrar:  {$e->getMessage()}",
            ];
        }
        return [
            'status' => 200,
            'message' => "Deletado com sucesso!",
        ];
    }
}
